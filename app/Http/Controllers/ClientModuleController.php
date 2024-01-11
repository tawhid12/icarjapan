<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        if (currentUser() == 'salesexecutive') {
            $users = User::with(['country', 'clientTransfers' => function ($query) {
                $query->latest('id')->limit(1);
            }]);
            if ($request->userId) {
                $users = $users->where('id', $request->userId);
            } elseif ($request->country_id) {
                $users = $users->where('country_id', $request->country_id);
            } elseif ($request->executiveId) {
                /* Null=> For Free Not Null Assigned (In Database)*/
                if ($request->executiveId == 1)
                    $users = $users->whereNull('executiveId');
                else
                    $users = $users->where('executiveId', currentUserId());
            } elseif ($request->type) {
                /* 1 => Active (Running deals on going) 2=> Semi Active (Purchased previously but at present no deals is running), 3 => Inactive (No purchase history or no deals is running)*/
                $users = $users->where('type', $request->type);
            } elseif ($request->created_at) {
                $created_at = explode('-', $request->created_at);
                $from = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[0]))->format('Y-m-d');
                $to = \Carbon\Carbon::createFromTimestamp(strtotime($created_at[1]))->format('Y-m-d');
                $users = $users->whereBetween('created_at', [$from, $to]);
            } elseif ($request->star) {
                $users = $users->where('cmType', $request->star);
            }
            if ($request->executiveId != 1) {
                $users = $users
                    ->where(function ($query) use ($request) {
                        $query->where('executiveId', '=', currentUserId());
                        //->orWhereNull('executiveId');
                    });
            }

            $users = $users->where('role_id', 4)->orderBy('id', $order_by)->paginate($perPage);
            $users = $users->appends(
                [
                    'userId' => $request->userId,
                    'country_id' => $request->country_id,
                    'order_by' => $request->order_by,
                    'executiveId' => $request->executiveId,
                    'type' => $request->type,
                ]
            );
                //$users=User::where('executiveId',currentUserId())->orWhere('executiveId',0)->where('role_id',4)->paginate(50);
                /*echo '<pre>';
            print_r($users->toArray());die*/;
            return view('cm_module.cm_module', compact('users', 'countries'));
        } elseif (currentUser() == 'accountant') {
            $countries = Country::all();
            $users = User::where('role_id', 4)->whereIn('type', [1,2])->paginate(50);
            return view('cm_module.cm_module', compact('users', 'countries'));
        } else {
            $users = User::paginate(10);
            return view('settings.adminusers.index', compact('users'));
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
        $payments = Payment::where('client_id', encryptor('decrypt', $id))->get();
        $deposits = Deposit::where('client_id', encryptor('decrypt', $id))->get();

        //print_r($con_detl);die;
        $countries = Country::all();
        $ports = Port::all();
        /*=== Reserve Unit ==*/
        $reserve_vehicle = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.allocated', 'reserved_vehicles.status as reserve_status', 'reserved_vehicles.total', 'reserved_vehicles.id as reserveId', 'reserved_vehicles.fob_amt', 'reserved_vehicles.shipment_type', 'reserved_vehicles.freight_amt', 'reserved_vehicles.insu_amt', 'reserved_vehicles.insp_amt', 'reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis', 'reserved_vehicles.m3_value', 'reserved_vehicles.m3_charge', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.user_id', encryptor('decrypt', $id))->orderBy('reserved_vehicles.id', 'DESC')
            ->paginate(25);
        /* Proforma Invoice For Confirm Order */
        $resrv = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('sub_brands', 'sub_brands.id', '=', 'vehicles.sub_brand_id')
            ->join('transmissions', 'vehicles.transmission_id', 'transmissions.id')
            ->select('reserved_vehicles.required_deposit','reserved_vehicles.allocated', 'reserved_vehicles.status as reserve_status', 'reserved_vehicles.total', 'reserved_vehicles.id as reserveId', 'reserved_vehicles.fob_amt', 'reserved_vehicles.shipment_type', 'reserved_vehicles.freight_amt', 'reserved_vehicles.insu_amt', 'reserved_vehicles.insp_amt', 'reserved_vehicles.aditional_cost', 'reserved_vehicles.discount as dis', 'reserved_vehicles.m3_value', 'reserved_vehicles.m3_charge', 'vehicles.*', 'brands.slug_name as b_slug', 'sub_brands.slug_name as sb_slug', 'transmissions.name as tname')
            ->where('reserved_vehicles.user_id', encryptor('decrypt', $id))->where('reserved_vehicles.status', 2)->orderBy('reserved_vehicles.id', 'DESC')
            ->paginate(25);
        /*echo '<pre>';
        print_r($reserve_vehicle->toArray());die;*/
        return view('cm_module.cm_module_individual', compact('client_data', 'sales_rank', 'countries', 'ports', 'client_details', 'reserve_vehicle', 'resrv', 'con_detl', 'invoices', 'payments', 'deposits'));
    }
    public function send_proforma_invoice($id)
    {
        $inv = Invoice::where('reserve_id', encryptor('decrypt', $id))->first();
        $com_info = CompanyAccountInfo::first();
        $client_data = User::where('id', $inv->client_id)->first();
        $executive_data = User::where('id', $inv->executiveId)->first();
        //dd($executive_data);
        $client_details = UserDetail::where('user_id', $inv->client_id)->first();
        $account_info = CompanyAccountInfo::first();
        $shipment = ShipmentDetail::where('client_id', $inv->client_id)->first();
        $v = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('body_types', 'body_types.id', '=', 'vehicles.body_type_id')
            ->join('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->join('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->select('vehicles.*','reserved_vehicles.required_deposit', 'brands.name as bName', 'body_types.name as btName', 'fuels.name as fName', 'transmissions.name as tName')
            ->where('vehicles.id', $inv->vehicle_id)->first();
            
        \Mail::send(
            /*'sales_module.invoice.proforma_mail'*/[],
            /*['inv' => $inv, 'com_info' => $com_info, 'client_data' => $client_data, 'client_details' => $client_details, 'account_info' => $account_info, 'shipment' => $shipment, 'v' => $v]*/[],
            function ($message) use ($inv, $com_info, $client_details, $client_data, $executive_data, $account_info, $shipment, $v) {

                $message->from('info@icarjapan.com', 'Icarjapan')
                ->to([$client_data->email,$executive_data->email])
                ->subject('Proforma Invoice For ' . $v->fullName . ' and Stock Id ' . $v->stock_id);
                //->view('email.template'); // Replace 'email.template' with the name of your email blade view
                // To Show view Before Download
                //return view('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
                $pdf = PDF::loadView('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
                $message->attachData($pdf->output(), 'proforma.pdf');
                //return  $pdf->download('proforma.pdf');//To Download For Check View
            }
        );
        return redirect()->back()->with(Toastr::success('Mail Sent Successful!', 'Success', ["positionClass" => "toast-top-right"]));;
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
        $v = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->join('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->join('body_types', 'body_types.id', '=', 'vehicles.body_type_id')
            ->join('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->join('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->select('vehicles.*', 'brands.name as bName', 'body_types.name as btName', 'fuels.name as fName', 'transmissions.name as tName')
            ->where('vehicles.id', $inv->vehicle_id)->first();
        // Your PDF generation code
        $pdf = PDF::loadView('sales_module.invoice.proforma_mail', compact('v', 'shipment', 'account_info', 'inv', 'com_info', 'client_data', 'client_details'));
        
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
