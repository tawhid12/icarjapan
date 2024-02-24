<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Validator;
use App\Http\Traits\ImageHandleTraits;
use DB;
use Toastr;

class ReviewController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with(['review_images','vehicle','user']);
        if (currentUser() == 'user') {
            $reviews = $reviews->where('reviews.client_id', currentUserId());
        }

        $reviews = $reviews->whereNull('reviews.deleted_at')->orderBy('id','desc')->paginate(10);

        if (currentUser() == 'superadmin') {
            return view('review.index', compact('reviews'));
        } else {
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                $location =  request()->session()->get('location');
                $countryName =  request()->session()->get('countryName');
                return view('user.review.index', compact('location', 'countryName', 'reviews'));
            } else {
                countryIp();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');
        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('user.review.create', compact('location', 'countryName'));
        } else {
            countryIp();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string',
            // 'email' => 'required|email',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string',
        ], [
            'rating.required' => 'Please provide a rating.',
            'rating.integer' => 'Rating must be an integer.',
            'rating.between' => 'Rating must be between 1 and 5.',
            'comment.required' => 'Please enter your comment.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new review
        $review = new Review();
        // $review->name = $request->input('name');
        // $review->email = $request->input('email');
        $review->purchase_id = $request->input('purchase_id');
        $review->client_id = currentUserId();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        if ($request->input('review_type')) {
            $review->review_type = $request->input('review_type');
        }
        if ($request->input('vehicle_id')) {
            $review->vehicle_id = $request->input('vehicle_id');
        }
        $review->save();
        //if ($request->has('upload')) $review->upload = 'uploads/review/' . $this->uploadImage($request->file('upload'), 'uploads/review');
        // Handle multiple image uploads
        if ($request->hasFile('upload')) {
            foreach ($request->file('upload') as $image) {
                // Save each image
                $path = $this->uploadImage($image, 'uploads/review');

                // Create a ReviewImage instance and associate it with the review
                $reviewImage = new ReviewImage();
                $reviewImage->review_id = $review->id; // Assuming review_id is the foreign key in ReviewImage table
                $reviewImage->upload = $path;
                $reviewImage->save();
            }
        }
        // Return success response
        return response()->json(['message' => 'Review submitted successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::findOrFail(encryptor('decrypt', $id));
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $r = Review::findOrFail(encryptor('decrypt', $id));
            if ($r::destroy(encryptor('decrypt', $id))) {
                return redirect()->back()->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
}
