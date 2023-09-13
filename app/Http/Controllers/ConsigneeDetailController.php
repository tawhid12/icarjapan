<?php

namespace App\Http\Controllers;

use App\Models\ConsigneeDetail;
use App\Models\Settings\Country;
use Illuminate\Http\Request;

use Toastr;

class ConsigneeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $con_detl = ConsigneeDetail::paginate(10);
        return view('user.consignee.index', compact('con_detl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $countries = Country::all();
        if (currentUser() == 'user')
            return view('user.consignee.create', compact('countries'));
        else
            return view('cm_module.consignee.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*echo '<pre>';
        print_r($request->toArray());die;*/
        try {
            $con = new ConsigneeDetail();
            if (currentUser() == 'user')
                $con->user_id = currentUserId();
            else
                $con->user_id = $request->user_id;
            $con->c_name = $request->c_name;
            $con->c_country_id = $request->c_country_id;
            $con->c_state = $request->c_state;
            $con->c_city = $request->c_city;
            $con->c_address = $request->c_address;
            $con->c_ref_address = $request->c_ref_address;
            $con->c_phone = str_replace(' ', ',', $request->c_phone);
            $con->c_email = str_replace(' ', ',', $request->c_email);
            if ($request->notify_same_as_con != 1) {
                $con->n_name = $request->n_name;
                $con->n_country_id = $request->n_country_id;
                $con->n_state = $request->n_state;
                $con->n_city = $request->n_city;
                $con->n_address = $request->n_address;
                $con->n_ref_address = $request->n_ref_address;
                $con->n_phone = str_replace(' ', ',', $request->n_phone);
                $con->n_email = str_replace(' ', ',', $request->n_email);
            }
            $con->notify_same_as_con = $request->notify_same_as_con == 1 ? $request->notify_same_as_con : 0;
            $con->per_con = $request->per_con == 1 ? $request->per_con : 0;

            $con->created_by = currentUserId();
            if ($con->save()) {
                if (currentUser() != 'user')
                    return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $request->user_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                else
                    return redirect()->route(currentUser() . 'consigdetl.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\ConsigneeDetail  $consigneeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ConsigneeDetail $consigneeDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsigneeDetail  $consigneeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $consignee = ConsigneeDetail::find(encryptor('decrypt', $id));
        if (currentUser() == 'user')
            return view('user.consignee.edit', compact('consignee', 'countries'));
        else
            return view('cm_module.consignee.edit', compact('consignee', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsigneeDetail  $consigneeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $con = ConsigneeDetail::find(encryptor('decrypt', $id));
            if (currentUser() == 'user')
                $con->user_id = currentUserId();
            else
                $con->user_id = $request->user_id;
            $con->c_name = $request->c_name;
            $con->c_country_id = $request->c_country_id;
            $con->c_state = $request->c_state;
            $con->c_city = $request->c_city;
            $con->c_address = $request->c_address;
            $con->c_ref_address = $request->c_ref_address;
            $con->c_phone = str_replace(' ', ',', $request->c_phone);
            $con->c_email = str_replace(' ', ',', $request->c_email);
            if ($request->notify_same_as_con != 1) {
                $con->n_name = $request->n_name;
                $con->n_country_id = $request->n_country_id;
                $con->n_state = $request->n_state;
                $con->n_city = $request->n_city;
                $con->n_address = $request->n_address;
                $con->n_ref_address = $request->n_ref_address;
                $con->n_phone = str_replace(' ', ',', $request->n_phone);
                $con->n_email = str_replace(' ', ',', $request->n_email);
            }
            $con->notify_same_as_con = $request->notify_same_as_con == 1 ? $request->notify_same_as_con : 0;
            $con->per_con = $request->per_con == 1 ? $request->per_con : 0;

            $con->updated_by = currentUserId();
            if ($con->save()) {
                if (currentUser() != 'user')
                    return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $request->user_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                else
                    return redirect()->route(currentUser() . '.consigdetl.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\ConsigneeDetail  $consigneeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsigneeDetail $consigneeDetail)
    {
        //
    }
}
