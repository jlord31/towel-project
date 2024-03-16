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
use App\Models\PropertyUnavailableDate;

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
                    $property->category_id = $req->input('type');
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
                    $property->longitude = $req->input('longtitude');
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
     * Fetch all images related to the specified property.
     */
    function fetchPropertyImages($id) 
    {
        $property = Property::findOrFail($id);

        $propertyImages = PropertyImages::where([['property_id', '=', $property->id]])->get();

        return response()->json(['status' => 'success', 'data' => $propertyImages]); 
    }

    function propertyDetails($id) 
    {
        $property = Property::findOrFail($id);

        $propertyImages = PropertyImages::where([['property_id', '=', $property->id]])->get();

        return view("property-details", compact('property','propertyImages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::where([['status', '=', 'active']])->get();

        $countries = Country::where([['status', '=', 'active']])->get();

        $facilities = Facility::where([['status', '=', 'active']])->get();

        $property = Property::findOrFail($id);

        $propertyImages = PropertyImages::where([['property_id', '=', $property->id]])->get();

        return view("edit-property", compact('property','propertyImages', 'categories', 'countries', 'facilities'));
    }

    function fetchAllFacilities() 
    {
        $facilities = Facility::where([['status', '!=', 'deleted']])->get();

        return response()->json(['status' => 'success', 'data' => $facilities]); 
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
    public function destroy($id)
    {
        // Retrieve the property model based on the submitted ID
        $property = Property::findOrFail($id);

        // Get the image path for the image in property table
        $oldImagePath = public_path('assets/uploads/properties/' . $property->image);

        // Delete the image path for the image in property table
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Retrieve associated images
        $propertyImages = PropertyImages::where([['property_id', '=', $property->id]])->get();

        // Delete associated images from storage
        foreach ($propertyImages as $image) {

            $propertyImagePath = public_path('assets/uploads/properties/' . $image->image);

            // Delete image file from storage
            if (File::exists($propertyImagePath)) 
            {
                File::delete($propertyImagePath);
            }

            // delete associated images of the property from the database
            $image->delete();
        }

        

        // Delete the property from the database
        $del = $property->delete();

        if ($del) 
        {
            // Return a success message
            return response()->json(['message' => 'Property deleted successfully']);
        } 
        else 
        {
            // Return an error message
            return response()->json(['message' => 'Error occurred when trying to delete Property']);
        }
        
    }

    /**
     * return the property unavliable date view.
     */
    function propertyUnavailableDateView() 
    {
        $property = Property::where([['status', '!=', 'deleted']])->get();

        $unavaliable = PropertyUnavailableDate::where([['status', '!=', 'deleted']])->get();

        return view("unavaliable-dates", compact('property','unavaliable'));
    }

    function storePropertyUnavailableDate(Request $req)  
    {
        // Split the date-time range into start and end date-time values
        [$startDateTime, $endDateTime] = explode(' - ', $req->input('reservationtime'));

        // Convert date-time strings to Carbon instances for easier handling
        $startDateTime = \Carbon\Carbon::parse($startDateTime);
        $endDateTime = \Carbon\Carbon::parse($endDateTime);

        $unavaliable = new PropertyUnavailableDate();
        $unavaliable->property_id = $req->input('property_id');
        $unavaliable->status = $req->input('status');
        $unavaliable->from = $startDateTime;
        $unavaliable->to = $endDateTime;

        // Save the unavaliable model
        $save = $unavaliable->save();

        if ($save) 
        {
            Session::flash('success', 'successfully added property unavaliable date');
            return back();
        } 
        else 
        {
            Session::flash('error', 'Error occurred when tring to add property unavaliable date');
            return back();
        }
    
    }

    function updatePropertyUavaliabilityStatus($id) 
    {
        $item = Property::findOrFail($id);
        
        // // Get the current status from the database
        $currentStatus = Property::where('id', $item->id)->value('status');

        // // Update the status based on its current value
        if ($currentStatus == 'active') 
        {
            Property::where('id', $item->id)->update(['status' => 'inactive']);
            $newStatus = 'inactive';
        } 
        else 
        {
            Property::where('id', $item->id)->update(['status' => 'active']);
            $newStatus = 'active';
        }

        // Return a JSON response indicating success or failure
        return response()->json(['status' => 'success', 'new_status' => $newStatus]);
    }

    function deleteUnavaliableDate($id) 
    {
        $item = PropertyUnavailableDate::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted property unavaliable date']);
    }
}
