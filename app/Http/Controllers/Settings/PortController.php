<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\Country;
use App\Models\Settings\Port;
use Illuminate\Http\Request;

use App\Http\Traits\ImageHandleTraits;
use Toastr;

class PortController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if($search != ''){
            $ports = Port::where('name','like', '%' .$search. '%')->paginate(25);
            $ports->appends(array('search'=> $search,));
            if(count($ports )>0){
            return view('settings.port.index',['ports'=>$ports]);
            }
            return back()->with('error','No results Found');
        } 
        $ports=Port::orderBy('inv_loc_id')->latest()->paginate(15);
        return view('settings.port.index',compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        return view('settings.port.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $p=new Port();
            $p->name=$request->name;
            $p->m3=$request->m3;
            $p->inv_loc_id=$request->inv_loc_id;
            $p->created_by=currentUserId();
            if($p->save()){
                return redirect()->route(currentUser().'.port.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function show(Port $port)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries=Country::all();
        $p=Port::findOrFail(encryptor('decrypt',$id));
        return view('settings.port.edit',compact('p','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $p=Port::findOrFail(encryptor('decrypt',$id));
            $p->m3=$request->m3;
            $p->inv_loc_id=$request->inv_loc_id;
            $p->updated_by=currentUserId();
            if($p->save())
                return redirect()->route(currentUser().'.port.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $port = Port::find(encryptor('decrypt',$id));
            if($port->delete()){
            return redirect()->route(currentUser().'.port.index')->with(Toastr::success('Data Deleted!', 'Success', ["positionClass" => "toast-top-right"]));
                }else{
                    return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }catch(Exception $e){
                //dd($e);
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
    }

    public function get_port_by_id(Request $request){
        $ports = Port::where('inv_loc_id',$request->id)->get();
        echo json_encode($ports);
    }
    public function get_m3_charge_by_port_id(Request $request){
        $m3 = Port::where('id',$request->id)->first();
        if($m3)
        echo $m3->m3;
        else
        echo $m3 = 0;
    }
}
