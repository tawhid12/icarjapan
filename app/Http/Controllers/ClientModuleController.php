<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ConsigneeDetail;
use App\Models\ReservedVehicle;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\UserDetail;
use App\Models\CompanyAccountInfo;
use App\Models\ShipmentDetail;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Deposit;

use Exception;
use Toastr;
use DB;
use PDF;

class ClientModuleController extends Controller
{
    public function all_client_list(Request $request)
    {
        $countries = Country::all();
        $order_by = $request->order_by ? $request->order_by : 'desc';
        $perPage = $request->perPage ? $request->perPage : 50;
        $sales_executives = User::where('role_id',3)->get();
       if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin') {
            $users = User::query();
            if ($request->userId) {
                $users->where(function($query) use ($request) {
                    $query->where('id', $request->userId)
                          ->orWhere('name', 'like', '%' . $request->userId . '%');
                });
            }
        
            if ($request->country_id) {
                $users->where('country_id', $request->country_id);
            }
        
            if ($request->cm_status  ==1) {
                $users->where('executiveId', 0)->where('created_by', 0);
            }
            
            if ($request->cm_status  ==2 && currentUser() == 'salesexecutive') {
                $users->where('executiveId', currentUserId());
            }
            
            if ($request->cm_status  ==2 && currentUser() == 'superadmin') {
                $users->where('executiveId','!=',0)->orWhere('created_by','!=',0);
            }

        
            if ($request->executive_id && !currentUser() == 'salesexecutive') {
                $users->where('executiveId', $request->executive_id)
                ->orWhereNull('executiveId');
            }
            
            if ($request->type) {
                /* 1 => Active (Running deals on going) 2=> Semi Active (Purchased previously but at present no deals is running), 3 => Inactive (No purchase history or no deals is running)*/
                $users = $users->where('type', $request->type);
            } 
            if ($request->created_at) {
                $created_at = explode('-', $request->created_at);
                $from = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[0]))->format('Y-m-d');
                $to = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[1]))->format('Y-m-d');
                $users = $users->whereBetween('created_at', [$from, $to]);
            }
            if ($request->star) {
                $users = $users->where('cmType', $request->star);
            }
        
            // Only restrict if current user is salesexecutive
            if (currentUser() == 'salesexecutive') {
                 $users->where(function ($query) use ($request) {
                    $query->where('executiveId', currentUserId())
                          ->OrWhere('executiveId',0);
                });
            }
        
            $users = $users->with(['country', 'createdBy', 'executive', 'clientTransfers'])
                           ->where('role_id', 4)
                           ->orderBy('id', $order_by)
                           ->paginate($perPage)
                           ->appends([
                                'userId' => $request->userId,
                                'country_id' => $request->country_id,
                                'order_by' => $request->order_by,
                                'executiveId' => $request->executiveId,
                                'type' => $request->type,
                                'cm_status' => $request->cm_status
                           ]);
        
            return view('cm_module.cm_module', compact('users', 'countries', 'sales_executives'));
        }elseif (currentUser() == 'accountant') {
            //dd($request->all());
            $countries = Country::all();
                $query = User::where('role_id', 4)
                ->whereIn('type', [1, 2]);

                if ($request->country_id) {
                    $query->where('country_id', $request->country_id);
                }
                if ($request->userId) {
                    $query = $query->where(function($query) use ($request){
                        $query->where('id', $request->userId);
                        $query->orWhere('name', 'like', '%' . $request->userId . '%');
                    });
                }
                if ($request->type) {
                    /* 1 => Active (Running deals on going) 2=> Semi Active (Purchased previously but at present no deals is running), 3 => Inactive (No purchase history or no deals is running)*/
                    $query = $query->where('type', $request->type);
                }
                if ($request->star) {
                    $query = $query->where('cmType', $request->star);
                }
                if ($request->created_at) {
                    $created_at = explode('-', $request->created_at);
                    $from = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[0]))->format('Y-m-d');
                    $to = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[1]))->format('Y-m-d');
                    $query = $query->whereBetween('created_at', [$from, $to]);
                }
                $users = $query->orderBy('id', $order_by)->paginate(50);
                $users = $users->appends(
                [
                    'userId' => $request->userId,
                    'country_id' => $request->country_id,
                    'order_by' => $request->order_by,
                ]
            );
            return view('cm_module.cm_module', compact('users', 'countries'));
        } else {
            $users = User::paginate(10);
            $roles = Role::all();
            $countries = Country::all();
            return view('settings.adminusers.index', compact('users','roles','countries'));
        }
    }
    public function client_individual($id)
    {
        $client_data = User::where('id', encryptor('decrypt', $id))->first();
        $client_details = UserDetail::where('user_id', encryptor('decrypt', $id))->first();
        //print_r($client_details->toArray());die;
        $sales_rank = ReservedVehicle::where('user_id', encryptor('decrypt', $id))->where('status', '2')->count();
        $user_status = ReservedVehicle::where('user_id', encryptor('decrypt', $id))->count();
        $con_detl = ConsigneeDetail::where('user_id', encryptor('decrypt', $id))->get();

        $invoices = Invoice::where('client_id', encryptor('decrypt', $id))->get();
        $payments = Payment::join('reserved_vehicles', 'payments.reserve_id', '=', 'reserved_vehicles.id')->where('client_id', encryptor('decrypt', $id))
        ->select('payments.*', 'reserved_vehicles.invoice_no') // include any fields you want
        ->get();
        $deposits = Deposit::where('client_id', encryptor('decrypt', $id))->get();

        //print_r($con_detl);die;
        $countries = Country::all();
        $ports = Port::all();
        /*=== Reserve Unit ==*/
        $reserve_vehicle = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->leftJoin('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.invoice_no','reserved_vehicles.allocated', 'reserved_vehicles.status as reserve_status', 'reserved_vehicles.total', 'reserved_vehicles.id as reserveId', 'reserved_vehicles.fob_amt', 'reserved_vehicles.shipment_type', 'reserved_vehicles.freight_amt', 'reserved_vehicles.insu_amt', 'reserved_vehicles.insp_amt', 'reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis', 'reserved_vehicles.m3_value', 'reserved_vehicles.m3_charge', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.user_id', encryptor('decrypt', $id))->orderBy('reserved_vehicles.id', 'DESC')
            ->paginate(200);
            
        $purchased_vehicle = DB::table('reserved_vehicles')
        ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
        ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
        ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
        ->leftJoin('transmissions', 'vehicles.transmission_id', 'transmissions.id')
        ->select('reserved_vehicles.allocated', 'reserved_vehicles.status as reserve_status', 'reserved_vehicles.total', 'reserved_vehicles.id as reserveId', 'reserved_vehicles.fob_amt', 'reserved_vehicles.shipment_type', 'reserved_vehicles.freight_amt', 'reserved_vehicles.insu_amt', 'reserved_vehicles.insp_amt', 'reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis', 'reserved_vehicles.m3_value', 'reserved_vehicles.m3_charge', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
        ->where('reserved_vehicles.user_id', encryptor('decrypt', $id))->where('sold_status',1)->orderBy('reserved_vehicles.id', 'DESC')
        ->paginate(25);
        /* Proforma Invoice For Confirm Order */
        $resrv = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->leftJoin('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.invoice_no','vehicles.sold_status','reserved_vehicles.required_deposit','reserved_vehicles.allocated', 'reserved_vehicles.status as reserve_status', 'reserved_vehicles.total', 'reserved_vehicles.id as reserveId', 'reserved_vehicles.fob_amt', 'reserved_vehicles.shipment_type', 'reserved_vehicles.freight_amt', 'reserved_vehicles.insu_amt', 'reserved_vehicles.insp_amt', 'reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis', 'reserved_vehicles.m3_value', 'reserved_vehicles.m3_charge', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.user_id', encryptor('decrypt', $id))->where('reserved_vehicles.status', 2)->orderBy('reserved_vehicles.id', 'DESC')
            ->paginate(200);
            
        /*echo '<pre>';
        print_r($reserve_vehicle->toArray());die;*/
        return view('cm_module.cm_module_individual', compact('client_data', 'sales_rank', 'countries', 'ports', 'client_details', 'reserve_vehicle', 'resrv', 'con_detl', 'invoices', 'payments', 'deposits','purchased_vehicle'));
    }
    public function send_proforma_invoice($id)
    {
        $inv = Invoice::where('reserve_id', encryptor('decrypt', $id))->first();
        $com_info = CompanyAccountInfo::first();
        $client_data = User::where('id', $inv->client_id)->first();
        $executive_data = User::where('id', $inv->executiveId)->first();
        //dd($executive_data);
        $client_details = UserDetail::where('user_id', $inv->client_id)->first();
        $country = DB::table('countries')->where('id', $client_data->country_id)->first()->name;
        $account_info = CompanyAccountInfo::first();
        $shipment = ShipmentDetail::where('client_id', $inv->client_id)->first();
        $v = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('body_types', 'body_types.id', '=', 'vehicles.body_type_id')
            ->join('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->join('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->select('vehicles.*','reserved_vehicles.required_deposit', 'brands.name as bName', 'body_types.name as btName', 'fuels.name as fName', 'transmissions.name as tName','reserved_vehicles.fob_amt','reserved_vehicles.m3_value','reserved_vehicles.m3_charge','reserved_vehicles.aditional_cost','reserved_vehicles.required_deposit','reserved_vehicles.total')
            ->where('reserved_vehicles.id', encryptor('decrypt', $id))->first();
       
        $payment = DB::table('payments')->where('reserve_id',encryptor('decrypt', $id))->get();
  
        $isPaid = $payment->isNotEmpty(); // Adjust based on your schema 
        $paidAmount = $payment->sum('amount');
        $vehicleTotal = $v->total;
        
        if ($paidAmount == 0) {
            // Proforma
            $invoiceType = 'proforma';
        } elseif ($paidAmount < $vehicleTotal) {
            // Due
            $invoiceType = 'due';
        } elseif ($paidAmount >= $vehicleTotal) {
            // Final
            $invoiceType = 'final';
        }

        
        // Select email view and subject based on payment status
        /*$emailView = $isPaid ? 'email.due_invoice_body' : 'email.proforma_body';
        $pdfView = 'sales_module.invoice.proforma_mail';
        $subjectPrefix = $isPaid
        ? 'Payment Due Reminder Invoice No ICJ' . \Carbon\Carbon::parse($inv->created_at)->format('Ymd') . $inv->id . ' -- ' . $country
        : 'Proforma Invoice For ' . $v->fullName . ' and Stock Id ' . $v->stock_id . ' -- ' . $country;*/
        switch ($invoiceType) {
            case 'proforma':
                $emailView = 'email.proforma_body';
                $pdfView = 'sales_module.invoice.proforma_mail';
                $subjectPrefix = 'Proforma Invoice For ' . $v->fullName . ' and Stock Id ' . $v->stock_id . ' -- ' . $country;
                break;
        
            case 'due':
                $emailView = 'email.due_invoice_body';
                $pdfView = 'sales_module.invoice.proforma_mail'; // If you have a separate due view, change here
                $subjectPrefix = 'Payment Due Reminder Stock Id ' . $v->stock_id . ' and Invoice No ICJ' . \Carbon\Carbon::parse($inv->created_at)->format('Ymd') . $inv->id . ' -- ' . $country;
                break;
        
            case 'final':
                $emailView = 'email.final_invoice_body';
                $pdfView = 'sales_module.invoice.proforma_mail';
                $subjectPrefix = 'Final Invoice for Vehicle Export Stock Id ' . $v->stock_id . ' -Invoice No ICJ' . \Carbon\Carbon::parse($inv->created_at)->format('Ymd') . $inv->id . ' -- ' . $country;
                break;
        }



        \Mail::send(
            $emailView,
            ['inv' => $inv, 'com_info' => $com_info, 'client_data' => $client_data, 'client_details' => $client_details, 'account_info' => $account_info, 'shipment' => $shipment, 'v' => $v,'payment' => $payment],
            function ($message) use ($inv, $com_info, $client_details, $client_data, $executive_data, $account_info, $shipment, $v,$country, $subjectPrefix, $pdfView,$payment) {

                $message->from('info@icarjapan.com', 'Icarjapan')
                //->to("tawhid8995@gmail.com")
                ->to([$client_data->email,$executive_data->email])
                ->cc([
                    'dev@icarjapan.com',
                    'office@icarjapan.com',
                    'ad-jp@icarjapan.com',
                    'icarjapanofficial@gmail.com'
                ]) // Multiple CC email addresses
                ->subject($subjectPrefix);
                //->view('email.template'); // Replace 'email.template' with the name of your email blade view
                // To Show view Before Download
                //return view('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
                //$pdf = PDF::loadView('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
                $pdf = PDF::loadView($pdfView, compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details','payment'));
                //$message->attachData($pdf->output(), 'proforma.pdf');
                $message->attachData($pdf->output(), strtolower(str_replace(' ', '_', $subjectPrefix)) . '.pdf');
                
                //return  $pdf->download('proforma.pdf');//To Download For Check View
            }
        );
        //return redirect()->back()->with(Toastr::success('Mail Sent Successful!', 'Success', ["positionClass" => "toast-top-right"]));
        return redirect()->to(currentUser().'/client-individual/' . encryptor('encrypt', $client_data->id))
    ->with(Toastr::success('Mail Sent Successfully!', 'Success', ["positionClass" => "toast-top-right"]));

    }
    public function downloadPDF($id)
    {
        $inv = Invoice::where('reserve_id', encryptor('decrypt', $id))->first();
        $com_info = CompanyAccountInfo::first();
        $client_data = User::where('id', $inv->client_id)->first();
        $executive_data = User::where('id', $inv->executiveId)->first();
        //dd($executive_data);
        $client_details = UserDetail::where('user_id', $inv->client_id)->first();
        $account_info = CompanyAccountInfo::first();
        $shipment = ShipmentDetail::where('client_id', $inv->client_id)->first();
        $payment = DB::table('payments')->where('reserve_id',encryptor('decrypt', $id))->get();
        $v = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('body_types', 'body_types.id', '=', 'vehicles.body_type_id')
            ->join('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->join('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->select('vehicles.*','reserved_vehicles.required_deposit', 'brands.name as bName', 'body_types.name as btName', 'fuels.name as fName', 'transmissions.name as tName','reserved_vehicles.fob_amt','reserved_vehicles.m3_value','reserved_vehicles.m3_charge','reserved_vehicles.aditional_cost','reserved_vehicles.required_deposit','reserved_vehicles.total')
            ->where('reserved_vehicles.id', encryptor('decrypt', $id))->first();
        // Your PDF generation code
        //return view('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
        $pdf =  PDF::loadView('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details','payment'))
                ->setPaper('a4', 'portrait');
        
        // Create the temp directory if it doesn't exist
        $tempDir = storage_path('app/public/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        // Save the PDF to a temporary file
        $pdfPath = $tempDir . '/proforma.pdf';
        $pdf->save($pdfPath);

        // Download the PDF file
        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }
}
