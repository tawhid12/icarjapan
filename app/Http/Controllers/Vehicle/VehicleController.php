<?php

namespace App\Http\Controllers\Vehicle;
use App\Http\Controllers\Controller;

use App\Models\Settings\BodyType;
use App\Models\Settings\DriveType;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\SubBodyType;

use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\VehicleModel;

use Illuminate\Http\Request;
use App\Http\Requests\Vehicle\Vehicle\AddNewRequest;
use App\Http\Requests\Vehicle\Vehicle\UpdateRequest;

use Toastr;
use Carbon\Carbon;
use DB;
use File;
use App\Http\Traits\ImageHandleTraits;
class VehicleController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles=Vehicle::latest()->paginate(15);
        return view('vehicle.vehicle.index',compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $fuel= Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();
        return view('vehicle.vehicle.create',compact('body_types','drive_types','inv_loc','sub_body_types','brands','fuel','colors','trans','vehicle_models'));
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
            $vehicle = New Vehicle();
            $vehicle->name = $request->name; 
            $vehicle->stock_id = $request->stock_id; 
            $vehicle->brand_id = $request->brand_id; 
            $vehicle->v_model_id = $request->v_model_id; 
            $vehicle->version = $request->version; 
            $vehicle->m3 = $request->m3; 
            $vehicle->weight = $request->weight; 
            $vehicle->model_code = $request->model_code; 
            $vehicle->chassis_no = $request->chassis_no; 
            $vehicle->fob = $request->fob; 
            $vehicle->steering = $request->steering; 
            $vehicle->body_type_id = $request->body_type_id; 
            $vehicle->sub_body_type_id = $request->sub_body_type_id; 
            $vehicle->drive_id = $request->drive_id; 
            $vehicle->price = $request->price; 
            $vehicle->cc = $request->cc; 
            $vehicle->mileage = $request->mileage; 
            $vehicle->transmission_id = $request->transmission_id; 
            $vehicle->discount = $request->discount; 
            $vehicle->fuel_id = $request->fuel_id; 
            $vehicle->color_id = $request->color_id; 
            $vehicle->b_length = $request->b_length; 
            $vehicle->max_loading_capacity = $request->max_loading_capacity; 
            $vehicle->e_size = $request->e_size; 
            $vehicle->year = date('Y',strtotime($request->year)); 
            $vehicle->reg_year = date('Y-m-d',strtotime($request->reg_year)); 
            $vehicle->manu_year = date('Y-m-d',strtotime($request->manu_year)); 
            $vehicle->inv_locatin_id = $request->inv_locatin_id; 
            $vehicle->air_bag = $request->air_bag==1? $request->air_bag:0;
            $vehicle->anti_lock_brake_system = $request->anti_lock_brake_system==1?$request->anti_lock_brake_system:0;
            $vehicle->air_con = $request->air_con==1?$request->air_con:0;
            $vehicle->back_tire = $request->back_tire==1?$request->back_tire:0;
            $vehicle->fog_lights = $request->fog_lights==1?$request->fog_lights:0;
            $vehicle->grill_guard = $request->grill_guard==1?$request->grill_guard:0;
            $vehicle->leather_seats = $request->leather_seats==1?$request->leather_seats:0;
            $vehicle->navigation = $request->navigation==1?$request->navigation:0;
            $vehicle->power_steering = $request->power_steering==1?$request->power_steering:0;
            $vehicle->power_windows = $request->power_windows==1?$request->power_windows:0;
            $vehicle->roof_rails = $request->roof_rails==1?$request->roof_rails:0;
            $vehicle->rear_spoiler = $request->rear_spoiler==1?$request->rear_spoiler:0;
            $vehicle->sun_roof = $request->sun_roof==1?$request->sun_roof:0;
            $vehicle->tv = $request->tv==1?$request->tv:0;
            $vehicle->dual_air_bags = $request->dual_air_bags==1?$request->dual_air_bags:0;
            //$vehicle = $request->image 
            $vehicle->v_link = $request->v_link; 
            $vehicle->created_by=currentUserId();
            if($vehicle->save()){
                if($request->hasFile('image')) {
                    //print_r($_FILES['image']);die;
                    $images = $request->file('image');
                    foreach($images as $key => $val){
                        $ext    = $val->extension();
                        $filename = time().uniqid().'.'.$ext;
                        $image_path = $val->storeAs('upload/vehicle_images',$filename,['disk' => 'public_uploads']);
                        $vehicleImagesArr['image']  = str_ireplace("public/","/storage/",$image_path);
                        $vehicleImagesArr['vehicle_id'] = $vehicle->id;
                        $vehicleImagesArr['created_at'] = Carbon::now();
                        DB::table('vehicle_images')->insert($vehicleImagesArr);
                    }
                }
                return redirect()->route(currentUser().'.vehicle.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $fuel= Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();

        $v=Vehicle::findOrFail(encryptor('decrypt',$id));
        $v_images = DB::table('vehicle_images')->where('vehicle_id',encryptor('decrypt',$id))->get();

        return view('vehicle.vehicle.show',compact('v_images','v','body_types','drive_types','inv_loc','sub_body_types','brands','fuel','colors','trans','vehicle_models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $fuel= Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();

        $v=Vehicle::findOrFail(encryptor('decrypt',$id));
        $v_images = DB::table('vehicle_images')->where('vehicle_id',encryptor('decrypt',$id))->get();

        return view('vehicle.vehicle.edit',compact('v_images','v','body_types','drive_types','inv_loc','sub_body_types','brands','fuel','colors','trans','vehicle_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $vehicle=Vehicle::findOrFail(encryptor('decrypt',$id));
            $vehicle->name = $request->name; 
            $vehicle->stock_id = $request->stock_id; 
            $vehicle->brand_id = $request->brand_id; 
            $vehicle->v_model_id = $request->v_model_id; 
            $vehicle->version = $request->version; 
            $vehicle->m3 = $request->m3; 
            $vehicle->weight = $request->weight; 
            $vehicle->model_code = $request->model_code; 
            $vehicle->chassis_no = $request->chassis_no; 
            $vehicle->fob = $request->fob; 
            $vehicle->steering = $request->steering; 
            $vehicle->body_type_id = $request->body_type_id; 
            $vehicle->sub_body_type_id = $request->sub_body_type_id; 
            $vehicle->drive_id = $request->drive_id; 
            $vehicle->price = $request->price; 
            $vehicle->cc = $request->cc; 
            $vehicle->mileage = $request->mileage; 
            $vehicle->transmission_id = $request->transmission_id; 
            $vehicle->discount = $request->discount; 
            $vehicle->fuel_id = $request->fuel_id; 
            $vehicle->color_id = $request->color_id; 
            $vehicle->b_length = $request->b_length; 
            $vehicle->max_loading_capacity = $request->max_loading_capacity; 
            $vehicle->e_size = $request->e_size; 
            $vehicle->year = date('Y',strtotime($request->year)); 
            $vehicle->reg_year = date('Y-m-d',strtotime($request->reg_year)); 
            $vehicle->manu_year = date('Y-m-d',strtotime($request->manu_year)); 
            $vehicle->inv_locatin_id = $request->inv_locatin_id; 
            $vehicle->air_bag = $request->air_bag==1? $request->air_bag:0;
            $vehicle->anti_lock_brake_system = $request->anti_lock_brake_system==1?$request->anti_lock_brake_system:0;
            $vehicle->air_con = $request->air_con==1?$request->air_con:0;
            $vehicle->back_tire = $request->back_tire==1?$request->back_tire:0;
            $vehicle->fog_lights = $request->fog_lights==1?$request->fog_lights:0;
            $vehicle->grill_guard = $request->grill_guard==1?$request->grill_guard:0;
            $vehicle->leather_seats = $request->leather_seats==1?$request->leather_seats:0;
            $vehicle->navigation = $request->navigation==1?$request->navigation:0;
            $vehicle->power_steering = $request->power_steering==1?$request->power_steering:0;
            $vehicle->power_windows = $request->power_windows==1?$request->power_windows:0;
            $vehicle->roof_rails = $request->roof_rails==1?$request->roof_rails:0;
            $vehicle->rear_spoiler = $request->rear_spoiler==1?$request->rear_spoiler:0;
            $vehicle->sun_roof = $request->sun_roof==1?$request->sun_roof:0;
            $vehicle->tv = $request->tv==1?$request->tv:0;
            $vehicle->dual_air_bags = $request->dual_air_bags==1?$request->dual_air_bags:0;
            //$vehicle = $request->image 
            $vehicle->v_link = $request->v_link; 
            $vehicle->updated_by=currentUserId();
            if($vehicle->save()){
                if($request->hasFile('image')) {
                    $images = $request->file('image');
                    foreach($images as  $val){
                        $vehicleImagesArr['image'] = $this->uploadImage($val, 'uploads/vehicle_images');
                        $vehicleImagesArr['vehicle_id'] = $vehicle->id;
                        $vehicleImagesArr['created_at'] = Carbon::now();
                        DB::table('vehicle_images')->insert($vehicleImagesArr);
                    }
                }
                return redirect()->route(currentUser().'.vehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    /*if($request->hasFile('image')) {
        $images = $request->file('image');
        foreach($images as $key => $val){
            $ext    = $val->extension();
            $filename = time().uniqid().'.'.$ext;
            $image_path = $val->storeAs('storage/upload/category_image',$filename,['disk' => 'public_uploads']);
            $categoryImagesArr['image']  = str_ireplace("public/","/storage/",$image_path);
            $categoryImagesArr['cat_id'] = $store->id;
            $categoryImagesArr['created_at'] = Carbon::now();
            DB::table('category_images')->insert($categoryImagesArr);
        }
    }*/
    
    public function deleteImg($id){
        $image = DB::table('vehicle_images')->where('id',$id)->first();
        if(File::delete(public_path($image->image))){
        DB::table('category_images')->delete($id);
        return redirect()->back()->with('success',"Category Image Deleted successfully");
        }else{
            return redirect()->route('vehicle.index')->with('error',"Something Went Worng!");
        }
    }
    
    
}