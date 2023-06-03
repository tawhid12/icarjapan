<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;

use App\Models\Settings\BodyType;
use App\Models\Settings\DriveType;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\SubBodyType;
use App\Models\Settings\Country;


use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Brand;
use App\Models\Vehicle\SubBrand;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\Door;
use App\Models\Vehicle\Seat;
use App\Models\Vehicle\Condition;

use Illuminate\Http\Request;
use App\Http\Requests\Vehicle\Vehicle\AddNewRequest;
use App\Http\Requests\Vehicle\Vehicle\UpdateRequest;

use Toastr;
use Carbon\Carbon;
use DB;
use File;
use App\Http\Traits\ImageHandleTraits;
use App\Models\Vehicle\NewArival;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

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
        $vehicles = Vehicle::latest()->paginate(20);
        return view('vehicle.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $sub_brands = SubBrand::all();
        $fuel = Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();
        $doors = Door::all();
        $seats = Seat::all();
        $cons = Condition::all();
        return view('vehicle.vehicle.create', compact('doors', 'seats', 'cons', 'sub_brands', 'countries', 'body_types', 'drive_types', 'inv_loc', 'sub_body_types', 'brands', 'fuel', 'colors', 'trans', 'vehicle_models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        /*echo '<pre>';
        print_r($request->toArray());die;*/
        try {
            $vehicle = new Vehicle();
            $vehicle->stock_id = $request->stock_id;
            $vehicle->search_keyword = str_replace(' ', ',', $request->search_keyword);
            $vehicle->brand_id = $request->brand_id;
            $vehicle->sub_brand_id = $request->sub_brand_id;
            $vehicle->package = $request->package;
            /*$vehicle->v_model_id = $request->v_model_id;
            $vehicle->version = $request->version;*/
            $m3 = $request->b_length * $request->b_width * $request->b_height;
            $rounded = floor($m3); // Get the integer part of the value
            $decimal = $m3 - $rounded; // Get the decimal part of the value
            if ($decimal >= 0.50) {
                $roundedValue = ceil($m3);
            } else {
                $roundedValue = $m3;
            }
            $vehicle->m3 = $roundedValue/*$request->m3*/;
            $vehicle->weight = $request->weight;
            //$vehicle->v_model = $request->v_model;
            $vehicle->chassis_no = $request->chassis_no;
            $vehicle->fob = $request->fob;
            $vehicle->steering = $request->steering;
            $vehicle->body_type_id = $request->body_type_id;
            //$vehicle->sub_body_type_id = $request->sub_body_type_id;
            $vehicle->door_id = $request->door_id;
            $vehicle->seat_id = $request->seat_id;
            $vehicle->con_id = $request->con_id;
            //$vehicle->truck_size = $request->truck_size;
            $vehicle->drive_id = $request->drive_id;
            $vehicle->price = $request->fob;
            //$vehicle->cc = $request->cc;
            $vehicle->mileage = $request->mileage;
            $vehicle->transmission_id = $request->transmission_id;
            $vehicle->discount = $request->discount;
            $vehicle->fuel_id = $request->fuel_id;
            $vehicle->ext_color_id = $request->ext_color_id;
            $vehicle->int_color_id = $request->int_color_id;
            $vehicle->b_length = $request->b_length;
            $vehicle->b_width = $request->b_width;
            $vehicle->b_height = $request->b_height;
            $vehicle->max_loading_capacity = $request->max_loading_capacity;
            $vehicle->e_size = $request->e_size;
            $vehicle->e_info = $request->e_info;
            $vehicle->e_code = $request->e_code;
            $vehicle->reg_year = $request->reg_year;
            //$vehicle->reg_year = $request->reg_year?Carbon::createFromFormat('d/m/Y', $request->reg_year)->format('Y-m-d'):null;    
            $vehicle->manu_year = $request->manu_year;
            $vehicle->inv_locatin_id = $request->inv_locatin_id;
            $vehicle->inv_port_id = $request->inv_port_id;
            $vehicle->description = $request->description;
            //$vehicle->note = $request->note;
            $vehicle->option = $request->option;
            $vehicle->cd_player = $request->cd_player == 1 ? $request->cd_player : 0;
            $vehicle->sun_roof = $request->sun_roof == 1 ? $request->sun_roof : 0;
            $vehicle->leather_seat = $request->leather_seat == 1 ? $request->leather_seat : 0;
            $vehicle->alloy_wheels = $request->alloy_wheels == 1 ? $request->alloy_wheels : 0;
            $vehicle->power_steering = $request->power_steering == 1 ? $request->power_steering : 0;
            $vehicle->power_windows = $request->power_windows == 1 ? $request->power_windows : 0;
            $vehicle->air_con = $request->air_con == 1 ? $request->air_con : 0;
            $vehicle->anti_lock_brake_system = $request->anti_lock_brake_system == 1 ? $request->anti_lock_brake_system : 0;
            $vehicle->air_bag = $request->air_bag == 1 ? $request->air_bag : 0;
            $vehicle->radio = $request->radio == 1 ? $request->radio : 0;
            $vehicle->cd_changer = $request->cd_changer == 1 ? $request->cd_changer : 0;
            $vehicle->dvd = $request->dvd == 1 ? $request->dvd : 0;
            $vehicle->tv = $request->tv == 1 ? $request->tv : 0;
            $vehicle->power_seat = $request->power_seat == 1 ? $request->power_seat : 0;
            $vehicle->back_tire = $request->back_tire == 1 ? $request->back_tire : 0;
            $vehicle->grill_guard = $request->grill_guard == 1 ? $request->grill_guard : 0;
            $vehicle->rear_spoiler = $request->rear_spoiler == 1 ? $request->rear_spoiler : 0;
            $vehicle->central_locking = $request->central_locking == 1 ? $request->central_locking : 0;
            $vehicle->jack = $request->jack == 1 ? $request->jack : 0;
            $vehicle->spare_tire = $request->spare_tire == 1 ? $request->spare_tire : 0;
            $vehicle->wheel_spanner = $request->wheel_spanner == 1 ? $request->wheel_spanner : 0;
            $vehicle->fog_lights = $request->fog_lights == 1 ? $request->fog_lights  : 0;
            $vehicle->back_camera = $request->back_camera == 1 ? $request->back_camera : 0;
            $vehicle->push_start = $request->push_start == 1 ? $request->push_start : 0;
            $vehicle->keyless_entry = $request->keyless_entry == 1 ? $request->keyless_entry : 0;
            $vehicle->esc = $request->esc == 1 ? $request->esc : 0;
            $vehicle->deg_360_cam = $request->deg_360_cam == 1 ? $request->deg_360_cam : 0;
            $vehicle->body_kit = $request->body_kit == 1 ? $request->body_kit : 0;
            $vehicle->side_airbag = $request->side_airbag == 1 ? $request->side_airbag : 0;
            $vehicle->power_mirror = $request->power_mirror == 1 ? $request->power_mirror : 0;
            $vehicle->side_skirts = $request->side_skirts == 1 ? $request->side_skirts : 0;
            $vehicle->front_lip_spoiler = $request->front_lip_spoiler == 1 ? $request->front_lip_spoiler : 0;
            $vehicle->navigation = $request->navigation == 1 ? $request->navigation : 0;
            $vehicle->turbo = $request->turbo == 1 ? $request->turbo : 0;
            //$vehicle = $request->image 
            $vehicle->v_link = $request->v_link;
            $vehicle->created_by = currentUserId();

            /*Long Name */
            $vehicle_name = DB::table('brands')->where('id', $request->brand_id)->first()->name . " " . DB::table('sub_brands')->where('id', $request->sub_brand_id)->first()->name . " " . str_replace(' ', '-', $request->package) . " " . $request->manu_year;
            $vehicle->fullName = $vehicle_name;

            /*Short Name */
            $vehicle->name = DB::table('brands')->where('id', $request->brand_id)->first()->name . " " . DB::table('sub_brands')->where('id', $request->sub_brand_id)->first()->name . " " . $request->manu_year;

            if ($vehicle->save()) {
                if ($request->hasFile('image')) {
                    $images = $request->file('image');
                    foreach ($images as  $index => $val) {
                        if ($val->isValid()) {
                            $validator = Validator::make(
                                ['image' => $val],
                                ['image' => 'required|image|mimes:jpeg,png,jpg|max:2048'],
                                [
                                    'image.required' => 'Please select at least one image.',
                                    'image.image' => 'Invalid image format.',
                                    'image.mimes' => 'Allowed image formats: jpeg, png, jpg.',
                                    'image.max' => 'The maximum allowed file size is 2MB.',
                                ]
                            );

                            if ($validator->fails()) {
                                $failedUploads[] = [
                                    'file' => 'File Name: ' . $val->getClientOriginalName(),
                                    'error' => $validator->errors()->first('image'),
                                ];
                                continue; // Skip this iteration if validation fails
                            }

                            $vehicleImagesArr['image'] = $this->uploadImage($val, 'uploads/vehicle_images');
                            $vehicleImagesArr['vehicle_id'] = $vehicle->id;
                            $vehicleImagesArr['created_at'] = Carbon::now();
                            DB::table('vehicle_images')->insert($vehicleImagesArr);

                            $image = Image::make(public_path('uploads/vehicle_images/' . $vehicleImagesArr['image']));
                            $image->resize(640, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            // Load the watermark image
                            $watermark = Image::make(public_path('uploads/watermark.png'));

                            // Increase the size of the watermark image
                            $watermark->resize(1000, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            // Apply the watermark to the original image
                            $image->insert($watermark, 'top-left', 0, 0);

                            // Save the modified image
                            $image->save(public_path('uploads/vehicle_images/' . $vehicleImagesArr['image']));
                            //return true;
                            //return 'Watermark added successfully.';
                        }

                        /*if ($request->hasFile('image')) {
                    $images = $request->file('image');
                    $imagePaths = [];
                    foreach ($images as $image) {
                        $imagePath = $image->store('temp');
                        $imagePaths[] = $imagePath;
                    }
                    foreach ($imagePaths as $imagePath) {
                        $image = Image::make(storage_path('app/' . $imagePath));*/

                        /*$image->text('ICAR JAPAN', 100, 100, function($font) {
                            $font->file('path/to/font.ttf');
                            $font->size(24);
                            $font->color('#ffffff');
                            $font->align('right');
                            $font->valign('bottom');
                        });*/

                        //$image->resize(640, 480);
                        /*$image->resize(640, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $image->fit(640, 480);
                        $image->save(public_path('uploads/vehicle_images/' . $image->basename));
                        \Storage::delete($imagePath);
                    }*/

                        /*foreach($images as  $val){
                        $vehicleImagesArr['image'] = $this->uploadImage($val, 'uploads/vehicle_images');
                        $vehicleImagesArr['vehicle_id'] = $vehicle->id;
                        $vehicleImagesArr['created_at'] = Carbon::now();
                        DB::table('vehicle_images')->insert($vehicleImagesArr);
                    }*/
                    }
                }


                /*== Vehicle Country Wise */
                if ($request->post('country_id')) {
                    $country_data = $request->post('country_id');
                    foreach ($country_data as $key => $c) {
                        $v_data = Vehicle::find($vehicle->id); //any user we want to find 
                        $v_data->countries()->attach($country_data[$key]);
                    }
                    /*==New Vehicle Arival Country Wise */
                    if ($request->post('arival_country_id')) {
                        $arival_country_data = $request->post('arival_country_id');
                        foreach ($arival_country_data as $key => $c) {
                            $v_data = Vehicle::find($vehicle->id); //any user we want to find 
                            $v_data->arival_country()->attach($arival_country_data[$key]);
                        }
                    }
                } else {
                    DB::table('countries_vehicles')->insert(['country_id' => null, 'vehicle_id' => $vehicle->id]);
                    DB::table('new_arivals')->insert(['country_id' => null, 'vehicle_id' => $vehicle->id]);
                }
                return redirect()->route(currentUser() . '.vehicle.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
        $fuel = Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();

        $v = Vehicle::findOrFail(encryptor('decrypt', $id));
        $v_images = DB::table('vehicle_images')->where('vehicle_id', encryptor('decrypt', $id))->get();

        return view('vehicle.vehicle.show', compact('v_images', 'v', 'body_types', 'drive_types', 'inv_loc', 'sub_body_types', 'brands', 'fuel', 'colors', 'trans', 'vehicle_models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $body_types = BodyType::all();
        $drive_types = DriveType::all();
        $inv_loc = InventoryLocation::all();
        $sub_body_types = SubBodyType::all();

        $brands = Brand::all();
        $sub_brands = SubBrand::all();
        $fuel = Fuel::all();
        $colors = Color::all();
        $trans = Transmission::all();
        $vehicle_models = VehicleModel::all();
        $doors = Door::all();
        $seats = Seat::all();
        $cons = Condition::all();

        $v = Vehicle::findOrFail(encryptor('decrypt', $id));
        $v_images = DB::table('vehicle_images')->where('vehicle_id', encryptor('decrypt', $id))->get();
        $vehicle_avaliable_country = array_values(DB::table('countries_vehicles')->where('vehicle_id', encryptor('decrypt', $id))->pluck('country_id')->toArray());
        $new_arivals = array_values(DB::table('new_arivals')->where('vehicle_id', encryptor('decrypt', $id))->pluck('country_id')->toArray());
        return view('vehicle.vehicle.edit', compact('doors', 'seats', 'cons', 'vehicle_avaliable_country', 'sub_brands', 'new_arivals', 'countries', 'v_images', 'v', 'body_types', 'drive_types', 'inv_loc', 'sub_body_types', 'brands', 'fuel', 'colors', 'trans', 'vehicle_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $vehicle = Vehicle::findOrFail(encryptor('decrypt', $id));
            $vehicle->search_keyword = str_replace(' ', ',', $request->search_keyword);
            $vehicle->stock_id = $request->stock_id;
            $vehicle->brand_id = $request->brand_id;
            $vehicle->sub_brand_id = $request->sub_brand_id;
            $vehicle->package = $request->package;
            $m3 = $request->b_length * $request->b_width * $request->b_height;
            $rounded = floor($m3); // Get the integer part of the value
            $decimal = $m3 - $rounded; // Get the decimal part of the value
            if ($decimal >= 0.50) {
                $roundedValue = ceil($m3);
            } else {
                $roundedValue = $m3;
            }
            $vehicle->m3 = $roundedValue/*$request->m3*/;
            $vehicle->weight = $request->weight;
            $vehicle->chassis_no = $request->chassis_no;
            $vehicle->fob = $request->fob;
            $vehicle->steering = $request->steering;
            $vehicle->body_type_id = $request->body_type_id;
            $vehicle->door_id = $request->door_id;
            $vehicle->seat_id = $request->seat_id;
            $vehicle->con_id = $request->con_id;
            $vehicle->drive_id = $request->drive_id;
            $vehicle->price = $request->fob;
            $vehicle->mileage = $request->mileage;
            $vehicle->transmission_id = $request->transmission_id;
            $vehicle->discount = $request->discount;
            $vehicle->fuel_id = $request->fuel_id;
            $vehicle->ext_color_id = $request->ext_color_id;
            $vehicle->int_color_id = $request->int_color_id;
            $vehicle->b_length = $request->b_length;
            $vehicle->b_width = $request->b_width;
            $vehicle->b_height = $request->b_height;
            $vehicle->max_loading_capacity = $request->max_loading_capacity;
            $vehicle->e_size = $request->e_size;
            $vehicle->e_info = $request->e_info;
            $vehicle->e_code = $request->e_code;
            $vehicle->reg_year = $request->reg_year;
            //$vehicle->reg_year = $request->reg_year?Carbon::createFromFormat('d/m/Y', $request->reg_year)->format('Y-m-d'):null;
            $vehicle->manu_year = $request->manu_year;
            $vehicle->inv_locatin_id = $request->inv_locatin_id;
            $vehicle->inv_port_id = $request->inv_port_id;
            $vehicle->description = $request->description;
            //$vehicle->note = $request->note;
            $vehicle->option = $request->option;
            $vehicle->cd_player = $request->cd_player == 1 ? $request->cd_player : 0;
            $vehicle->sun_roof = $request->sun_roof == 1 ? $request->sun_roof : 0;
            $vehicle->leather_seat = $request->leather_seat == 1 ? $request->leather_seat : 0;
            $vehicle->alloy_wheels = $request->alloy_wheels == 1 ? $request->alloy_wheels : 0;
            $vehicle->power_steering = $request->power_steering == 1 ? $request->power_steering : 0;
            $vehicle->power_windows = $request->power_windows == 1 ? $request->power_windows : 0;
            $vehicle->air_con = $request->air_con == 1 ? $request->air_con : 0;
            $vehicle->anti_lock_brake_system = $request->anti_lock_brake_system == 1 ? $request->anti_lock_brake_system : 0;
            $vehicle->air_bag = $request->air_bag == 1 ? $request->air_bag : 0;
            $vehicle->radio = $request->radio == 1 ? $request->radio : 0;
            $vehicle->cd_changer = $request->cd_changer == 1 ? $request->cd_changer : 0;
            $vehicle->back_tire = $request->back_tire == 1 ? $request->back_tire : 0;
            $vehicle->dvd = $request->dvd == 1 ? $request->dvd : 0;
            $vehicle->tv = $request->tv == 1 ? $request->tv : 0;
            $vehicle->power_seat = $request->power_seat == 1 ? $request->power_seat : 0;
            $vehicle->back_tire = $request->back_tire == 1 ? $request->back_tire : 0;
            $vehicle->grill_guard = $request->grill_guard == 1 ? $request->grill_guard : 0;
            $vehicle->back_tire = $request->back_tire == 1 ? $request->back_tire : 0;
            $vehicle->rear_spoiler = $request->rear_spoiler == 1 ? $request->rear_spoiler : 0;
            $vehicle->central_locking = $request->central_locking == 1 ? $request->central_locking : 0;
            $vehicle->jack = $request->jack == 1 ? $request->jack : 0;
            $vehicle->spare_tire = $request->spare_tire == 1 ? $request->spare_tire : 0;
            $vehicle->wheel_spanner = $request->wheel_spanner == 1 ? $request->wheel_spanner : 0;
            $vehicle->fog_lights = $request->fog_lights == 1 ? $request->fog_lights  : 0;
            $vehicle->back_camera = $request->back_camera == 1 ? $request->back_camera : 0;
            $vehicle->push_start = $request->push_start == 1 ? $request->push_start : 0;
            $vehicle->keyless_entry = $request->keyless_entry == 1 ? $request->keyless_entry : 0;
            $vehicle->esc = $request->esc == 1 ? $request->esc : 0;
            $vehicle->deg_360_cam = $request->deg_360_cam == 1 ? $request->deg_360_cam : 0;
            $vehicle->body_kit = $request->body_kit == 1 ? $request->body_kit : 0;
            $vehicle->side_airbag = $request->side_airbag == 1 ? $request->side_airbag : 0;
            $vehicle->power_mirror = $request->power_mirror == 1 ? $request->power_mirror : 0;
            $vehicle->back_tire = $request->back_tire == 1 ? $request->back_tire : 0;
            $vehicle->side_skirts = $request->side_skirts == 1 ? $request->side_skirts : 0;
            $vehicle->front_lip_spoiler = $request->front_lip_spoiler == 1 ? $request->front_lip_spoiler : 0;
            $vehicle->navigation = $request->navigation == 1 ? $request->navigation : 0;
            $vehicle->turbo = $request->turbo == 1 ? $request->turbo : 0;
            //$vehicle = $request->image 
            //$vehicle->v_link = $request->v_link;
            $vehicle->updated_by = currentUserId();


            /*Long Name */
            $vehicle_name = DB::table('brands')->where('id', $request->brand_id)->first()->name . " " . DB::table('sub_brands')->where('id', $request->sub_brand_id)->first()->name . " " . str_replace(' ', '-', $request->package) . " " . $request->manu_year;
            $vehicle->fullName = $vehicle_name;

            /*Short Name */
            $vehicle->name = DB::table('brands')->where('id', $request->brand_id)->first()->name . " " . DB::table('sub_brands')->where('id', $request->sub_brand_id)->first()->name . " " . $request->manu_year;
            $failedUploads = [];
            if ($vehicle->save()) {
                if ($request->hasFile('image')) {
                    $images = $request->file('image');
                    foreach ($images as $val) {
                        if ($val->isValid()) {
                            $validator = Validator::make(
                                ['image' => $val],
                                ['image' => 'required|image|mimes:jpeg,png,jpg|max:2048'],
                                [
                                    'image.required' => 'Please select at least one image.',
                                    'image.image' => 'Invalid image format.',
                                    'image.mimes' => 'Allowed image formats: jpeg, png, jpg.',
                                    'image.max' => 'The maximum allowed file size is 2MB.',
                                ]
                            );

                            if ($validator->fails()) {
                                $failedUploads[] = [
                                    'file' => 'File Name: ' . $val->getClientOriginalName(),
                                    'error' => $validator->errors()->first('image'),
                                ];
                                continue; // Skip this iteration if validation fails
                            }


                            $vehicleImagesArr['image'] = $this->uploadImage($val, 'uploads/vehicle_images');
                            $vehicleImagesArr['vehicle_id'] = $vehicle->id;
                            $vehicleImagesArr['created_at'] = Carbon::now();
                            DB::table('vehicle_images')->insert($vehicleImagesArr);

                            $image = Image::make(public_path('uploads/vehicle_images/' . $vehicleImagesArr['image']));
                            $image->resize(640, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            // Load the watermark image
                            $watermark = Image::make(public_path('uploads/watermark.png'));

                            // Increase the size of the watermark image
                            $watermark->resize(180, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            // Apply the watermark to the original image
                            $image->insert($watermark, 'top-left', 0, 0);

                            // Save the modified image
                            $image->save(public_path('uploads/vehicle_images/' . $vehicleImagesArr['image']));
                            //return true;
                            //return 'Watermark added successfully.';
                        }
                    }
                }
                /*== Vehicle Country Wise */
                if ($request->post('country_id')) {
                    // start the transaction
                    DB::beginTransaction();
                    try {
                        // delete the data
                        DB::table('countries_vehicles')->where('vehicle_id', '=', $vehicle->id)->delete();
                        // insert new data
                        $country_data = $request->post('country_id');
                        foreach ($country_data as $key => $c) {
                            $data = array(
                                'country_id' => $country_data[$key],
                                'vehicle_id' => $vehicle->id
                            );
                            DB::table('countries_vehicles')->insert($data);
                        }
                        // commit the transaction
                        DB::commit();
                    } catch (\Exception $e) {
                        // something went wrong, roll back the transaction
                        DB::rollBack();
                    }
                } else {
                    // start the transaction
                    DB::beginTransaction();
                    try {
                        // delete the data
                        DB::table('countries_vehicles')->where('vehicle_id', '=', $vehicle->id)->delete();
                        // insert new data
                        DB::table('countries_vehicles')->insert(['country_id' => null, 'vehicle_id' => $vehicle->id]);
                        // commit the transaction
                        DB::commit();
                    } catch (\Exception $e) {
                        // something went wrong, roll back the transaction
                        DB::rollBack();
                    }
                }
                /*== Vehicle Arival Wise */
                if ($request->post('arival_country_id')) {
                    // start the transaction
                    DB::beginTransaction();
                    try {
                        // delete the data
                        DB::table('new_arivals')->where('vehicle_id', '=', $vehicle->id)->delete();
                        // insert new data
                        $arival_country_data = $request->post('arival_country_id');
                        foreach ($arival_country_data as $key => $c) {
                            $data = array(
                                'country_id' => $arival_country_data[$key],
                                'vehicle_id' => $vehicle->id
                            );
                            DB::table('new_arivals')->insert($data);
                        }
                        // commit the transaction
                        DB::commit();
                    } catch (\Exception $e) {
                        // something went wrong, roll back the transaction
                        DB::rollBack();
                    }
                } else {
                    // start the transaction
                    DB::beginTransaction();
                    try {
                        // delete the data
                        DB::table('new_arivals')->where('vehicle_id', '=', $vehicle->id)->delete();
                        // insert new data
                        DB::table('new_arivals')->insert(['country_id' => null, 'vehicle_id' => $vehicle->id]);
                        // commit the transaction
                        DB::commit();
                    } catch (\Exception $e) {
                        // something went wrong, roll back the transaction
                        DB::rollBack();
                    }
                }
                if (count($failedUploads) > 0) {
                    return redirect()->route(currentUser() . '.vehicle.edit', encryptor('encrypt', $vehicle->id))->with('failedUploads', $failedUploads);
                }



                return redirect()->route(currentUser() . '.vehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            /*$vehicle = Vehicle::find(encryptor('decrypt', $id));
            $vehicle_images = DB::table('vehicle_images')->where('vehicle_id', $id)->get();
            foreach ($vehicle_images as $v) {
                if (File::exists(public_path($v->image))) {
                    File::delete(public_path($v->image));
                }
            }
            DB::table('vehicle_images')->where('vehicle_id', $id)->delete();
            if ($vehicle->delete()) {
                DB::table('new_arivals')->where('vehicle_id', $id)->delete();
                DB::table('countries_vehicles')->where('vehicle_id', $id)->delete();
                return redirect()->route(currentUser() . '.vehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {*/
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            //}
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
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

    public function deleteImg(Request $request)
    {
        $delete_img = $request->post('delete');
        foreach ($delete_img as $id) {
            $image = DB::table('vehicle_images')->where('id', $id)->first();
            if (File::delete(public_path('uploads/vehicle_images/' . $image->image))) {
                DB::table('vehicle_images')->delete($id);
                return redirect()->back()->with('success', "Vehicle Image Deleted successfully");
            } else {
                return redirect()->route(currentUser() . '.vehicle.index')->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }
    }
    public function galleryCover($id)
    {
        $cover_img = DB::table('vehicle_images')->where('id', $id)->first();
        DB::table('vehicle_images')->where('vehicle_id', $cover_img->vehicle_id)->update(['is_cover_img' => null]);
        if (DB::table('vehicle_images')->where('id', $id)->update(['is_cover_img' => 1])) {
            return redirect()->back()->with('success', "Vehicle Image Deleted successfully");
        } else {
            return redirect()->route(currentUser() . '.vehicle.index')->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    public function addWatermark()
    {
        // Load the original image
        $image = Image::make(public_path('uploads/vehicle_images/test.jpg'));
        //print_r($image);die;

        // Load the watermark image
        $watermark = Image::make(public_path('uploads/watermark.png'));

        // Increase the size of the watermark image
        $watermark->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Apply the watermark to the original image
        $image->insert($watermark, 'top-left', 100, 60);

        // Save the modified image
        $image->save(public_path('uploads/test.jpg'));
        return true;
        //return 'Watermark added successfully.';
    }
    public function addWatermarkall()
    {
        $directory = public_path('uploads/vehicle_images');

        if (File::isDirectory($directory)) {
            $files = File::files($directory);

            foreach ($files as $file) {
                /*echo $file->getFilename() . '<br>';
                die;*/
                // Load the original image
                $image = Image::make(public_path('uploads/vehicle_images/' . $file->getFilename()));

                // Load the watermark image
                $watermark = Image::make(public_path('uploads/watermark.png'));

                // Increase the size of the watermark image
                $watermark->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // Apply the watermark to the original image
                $image->insert($watermark, 'top-left', 10, 10);
                // Save the modified image
                $image->save(public_path('uploads/vehicle_images/' . $file->getFilename()));
            }
        }









        return 'Watermark added successfully.';
    }

    /*
    $files = DB::table('vehicle_images')->pluck('image'); // Retrieve all file names from the database
        $directory = public_path('uploads/vehicle_images');
        foreach ($files as $file) {
            $filePath = $directory . '/' . $file;
        
            if (File::exists($filePath)) {
                // The file exists in the directory
                echo "File {$file} exists."."<br>";
            } else {
                // The file doesn't exist in the directory
                echo "File {$file} does not exist.";
                DB::table('vehicle_images')->where('image', $file)->delete();

            }
        }*/
}
