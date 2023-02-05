<?php

namespace App\Http\Controllers\Vehicle;
use App\Http\Controllers\Controller;

use App\Models\Vehicle\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Vehicle\Brand\AddNewRequest;
use App\Http\Requests\Vehicle\Brand\UpdateRequest;
use App\Http\Traits\ImageHandleTraits;
use Toastr;

class BrandController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::latest()->paginate(15);
        return view('vehicle.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        try{
            $b=new Brand;
            $b->name=$request->name;
            $b->created_by=currentUserId();
            if($request->has('image')) $b->image = $this->uploadImage($request->file('image'), 'uploads/brands');
            if($b->save()){

                return redirect()->route(currentUser().'.brand.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $b=Brand::findOrFail(encryptor('decrypt',$id));
        return view('vehicle.brand.edit',compact('b'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $b=Brand::findOrFail(encryptor('decrypt',$id));
            $b->name=$request->name;
            $b->updated_by=currentUserId();
            if($request->has('image')) $b->image = $this->uploadImage($request->file('image'), 'uploads/brands');
            if($b->save()){
                return redirect()->route(currentUser().'.brand.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
