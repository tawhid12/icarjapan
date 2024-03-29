<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Toastr;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (currentUser() == 'user') {
            $all_in = Inquiry::where('created_by', currentUserId())->orderBy('id','desc')->paginate();

            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('user.inquiry.index', compact('all_in','location'));
            }else{
                countryIp();
            }
        } else {
            $all_in = Inquiry::orderBy('id','desc')->paginate();
            return view('settings.inquiry.index', compact('all_in'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $in = new Inquiry;
            $in->name = $request->name;
            $in->country_id = $request->country_id;
            $in->city = $request->city;
            $in->email = $request->email;
            $in->phone = $request->phone;
            $in->remarks = $request->remarks;
            $in->vehicle_id = $request->vehicle_id;
            $in->created_by = currentUserId();

            if ($in->save()) {
                $inquiry = Inquiry::with('country')->findOrFail($in->id);
                $v_data = Vehicle::where('id', $inquiry->vehicle_id)->first();
                $type = 1; //Inquiry Received
                /*To User */
                \Mail::send('mail.reply_user_body', ['inquiry' => $inquiry, 'type' => $type], function ($message) use ($inquiry, $v_data) {
                    $message->from('info@icarjapan.com', 'Icarjapan')
                        ->to($inquiry->email)
                        ->subject('Inquiry For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
                });
                /*To Admin */
                \Mail::send('mail.reply_admin_body', ['inquiry' => $inquiry, 'v_data' => $v_data, 'type' => $type], function ($message) use ($v_data) {
                    $message->from('info@icarjapan.com', 'Icarjapan')
                        ->to('icarjapanofficial@gmail.com')
                        ->subject('Inquiry For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
                });
                // Redirect user to intended URL
                return redirect()->back()->with(Toastr::success('Inquiry Received!', 'Success', ["positionClass" => "toast-top-right"]));;
                //return redirect()->route(currentUser().'.brand.index')
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail(encryptor('decrypt', $id));
        return view('settings.inquiry.edit', compact('inquiry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $inquiry = Inquiry::findOrFail(encryptor('decrypt', $id));
            $inquiry->reply = $request->reply;
            $inquiry->replied_by = currentUserId();
            if ($inquiry->save()) {
                $inquiry = Inquiry::findOrFail($inquiry->id);
                $v_data = Vehicle::where('id', $inquiry->vehicle_id)->first();
                /*To User */
                $type = 2; //reply
                \Mail::send('mail.reply_user_body', ['inquiry' => $inquiry, 'type' => $type], function ($message) use ($inquiry, $v_data) {
                    $message->from('info@icarjapan.com', 'Icarjapan')
                        ->to($inquiry->email)
                        ->subject('Reply For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
                });
                /*To Admin */
                \Mail::send('mail.reply_admin_body', ['inquiry' => $inquiry, 'v_data' => $v_data, 'type' => $type], function ($message) use ($v_data) {
                    $message->from('info@icarjapan.com', 'Icarjapan')
                        ->to('icarjapanofficial@gmail.com')
                        ->subject('Reply For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
                });
            }
            if ($inquiry->save()) {
                return redirect()->route(currentUser() . '.inquiry.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        //
    }
}
