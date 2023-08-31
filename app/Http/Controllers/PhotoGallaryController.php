<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\ImageHandleTraits;
use App\Models\Vehicle\VehicleImage;
use Illuminate\Support\Facades\Storage;
use Exception;
use DB;
use Intervention\Image\Facades\Image;
class PhotoGallaryController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $images = VehicleImage::where('vehicle_id', $request->gid)->get()->toArray();
        foreach ($images as $image) {
            $tableImages[] = $image['image'];
        }
        $data = array();
        $storeFolder = public_path('uploads/vehicle_images');
        $file_path = public_path('uploads/vehicle_images/');
        $files = scandir($storeFolder);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('uploads/vehicle_images/') . $file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('public/uploads/vehicle_images/' . $file);
                $data[] = $obj;
            }
        }
        //dd($data);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $image->move(public_path('uploads/vehicle_images'), $file_name);
        $image = Image::make(public_path('uploads/vehicle_images/' . $file_name));
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
        $image->save(public_path('uploads/vehicle_images/' . $file_name));

        $imageUpload = new VehicleImage;
        $imageUpload->vehicle_id = $request->vehicle_id;
        $imageUpload->image = $file_name;
        $imageUpload->save();
        return response()->json(['success' => $file_name]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\photoGallary  $photoGallary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pGalleryCat = encryptor('decrypt', $id);
        return view('pGallery.photo', compact('pGalleryCat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\photoGallary  $photoGallary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\photoGallary  $photoGallary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
    public function delete(Request $request)
    {
        $filename =  $request->get('filename');
        VehicleImage::where('image', $filename)->delete();
        $path = public_path('uploads/vehicle_images/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\photoGallary  $photoGallary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
