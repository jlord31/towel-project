<?php

namespace App\Http\Controllers;


use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Admin;
use App\Models\Country;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Report;
use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyImages;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['login']);
    }
    /**
     * Display a listing of the resource.
     */

    // display property page
    public function index()
    {
        $categories = Category::where([['status', '=', 'active']])->get();

        $countries = Country::where([['status', '=', 'active']])->get();

        $facilities = Facility::where([['status', '=', 'active']])->get();

        return view("add-property", compact('categories', 'countries', 'facilities'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        
        // Handle file uploads & text
        //$uploadedFiles = [];
        if ($req->hasFile('files')) 
        {
            foreach ($req->file('files') as $index => $file) 
            {
                // Store the first file in the properties table
                if ($index === 0) 
                {
                    if (is_array($req->input('facility'))) 
                    {
                        $facility = implode(', ', $req->input('facility'));
                    } 
                    else 
                    {
                        $facility = $req->input('facility');
                    }

                    $company_profit = (int)$req->input('customer_price') - (int)$req->input('actual_price');

                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->move(public_path('assets/uploads/properties/'),$fileName);


                    $property = new Property();
                    $property->title = $req->input('title');
                    $property->description = $req->input('description');
                    $property->status = $req->input('status');
                    $property->type = $req->input('type');
                    $property->country_id = $req->input('country');
                    $property->city = $req->input('city');
                    $property->address = $req->input('address');
                    $property->people_limit = $req->input('people_limit');
                    $property->customer_price = $req->input('customer_price');
                    $property->actual_price = $req->input('actual_price');
                    $property->beds = $req->input('beds');
                    $property->bathroom = $req->input('bathroom');
                    $property->facility = $facility;
                    $property->company_profit = $company_profit;
                    $property->longtitude = $req->input('longtitude');
                    $property->latitude = $req->input('latitude');

                    // Store the file in a desired location and set the image column accordingly
                    $property->image = $fileName; 
                    $property->save();
                } 
                else 
                {
                    // Store the rest of the files in the property_images table
                    $propertyImage = new PropertyImages();
                    $propertyImage->property_id = $property->id; // use $property available from the previous step

                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->move(public_path('assets/uploads/properties/'),$fileName);

                    // Store the file in a desired location and set the image_url column accordingly
                    $propertyImage->image = $fileName; 
                    $propertyImage->save();
                }
                // $filename = $file->getClientOriginalName();
                // $uploadedFiles[] = $filename;
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Successfully uploaded property']);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $properties = Property::where([['status', '!=', 'deleted']])->get();
        
        return view("view-property", compact('properties'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
