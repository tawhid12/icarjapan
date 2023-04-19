<?php

namespace App\Http\Controllers\Vehicle;
use App\Http\Controllers\Controller;

use App\Models\Vehicle\Brand;
use App\Models\Vehicle\SubBrand;
use App\Http\Requests\StoreSubBrandRequest;
use App\Http\Requests\UpdateSubBrandRequest;
use Illuminate\Http\Request;
use App\Http\Traits\ImageHandleTraits;
use Toastr;

class SubBrandController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_brands=SubBrand::latest()->paginate(15);
        return view('vehicle.sub_brand.index',compact('sub_brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('vehicle.sub_brand.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $sb=new SubBrand();
            $sb->name=$request->name;
            $sb->slug=strtolower(str_replace(' ', '-', $request->name));
            $sb->brand_id=$request->brand_id;
            $sb->created_by=currentUserId();
            if($request->has('image')) $b->image = $this->uploadImage($request->file('image'), 'uploads/sub_brands');
            if($sb->save()){

                return redirect()->route(currentUser().'.subBrand.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\SubBrand  $subBrand
     * @return \Illuminate\Http\Response
     */
    public function show(SubBrand $subBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubBrand  $subBrand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sb=SubBrand::findOrFail(encryptor('decrypt',$id));
        $brands = Brand::all();
        return view('vehicle.sub_brand.edit',compact('sb','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubBrandRequest  $request
     * @param  \App\Models\SubBrand  $subBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $sb=SubBrand::findOrFail(encryptor('decrypt',$id));
            $sb->name=$request->name;
            $sb->slug_name=strtolower(str_replace(' ', '-', $request->name));
            $sb->brand_id=$request->brand_id;
            $sb->updated_by=currentUserId();
            if($request->has('image')) $sb->image = $this->uploadImage($request->file('image'), 'uploads/sub_brands');
            if($sb->save()){
                return redirect()->route(currentUser().'.subBrand.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubBrand  $subBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubBrand $subBrand)
    {
        //
    }
}
