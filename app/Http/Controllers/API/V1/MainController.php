<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\PropertyUnavailableDate;
use App\Models\PaymentMethod;

class MainController extends Controller
{
    function property(Request $req) 
    {
        // Check if a category parameter is provided
        if ($req->has('category')) 
        {
            // Retrieve the category ID based on the provided category name
            $categoryName = $req->category;
            $category = Category::where([['title', '=', $categoryName], ['status', '=', 'active']])->first();

            // Check if the category exists
            if ($category) 
            {
                // Retrieve properties filtered by the category ID
                $properties = Property::where('category_id', $category->id)->get();
            } 
            else 
            {
                // If the category doesn't exist, return an empty response or an error message
                return response()->json(['message' => 'Category not found'], 404);
            }
        } 
        else 
        {
            // Retrieve all properties
            $properties = Property::where([['status', '=', 'active']])->get();
        }

        // Retrieve all property images
        $propertyImages = PropertyImages::select('id', 'property_id', 'image')->get();

        // Retrieve property unavailable dates
        $propertyUnavailableDates = PropertyUnavailableDate::select('id', 'property_id', 'from', 'to')->where([['status', '=', 'active']])->get();

        // Prepare the data for the response
        $propertyData = [];
        foreach ($properties as $property) 
        {
            $propertyDetails = $property->toArray();

            // Find the image path for the property
            $propertyImagePath = asset('assets/uploads/properties/' . $property->image);
            $propertyDetails['image'] = $propertyImagePath;

            // Find property images associated with the current property
            $images = $propertyImages->where('property_id', $property->id)->toArray();

            // Append full image URLs to the image data
            foreach ($images as &$image) {
                $image['image'] = asset('assets/uploads/properties/' . $image['image']);
            }

            // Find unavailable dates associated with the current property
            $unavailableDates = $propertyUnavailableDates->where('property_id', $property->id)->toArray();

            // Add property images and unavailable dates to the property details
            $propertyDetails['property_images'] = $images;
            $propertyDetails['unavailable_dates'] = $unavailableDates;

            // Add the property details to the property data array
            $propertyData[] = $propertyDetails;
        }

        // Prepare API response
        $response = [
            'message' => 'Available properties',
            'properties' => $propertyData,
        ];

        // Return API response as JSON
        return response()->json($response, 200);
    }

    function getCategory() 
    {
        $categories = Category::where([['status', '=', 'active']])->get();

        // Prepare the data for the response
        $categoryData = [];
        foreach ($categories as $cat) 
        {
            $categoryDetails = $cat->toArray();

            // Find the image path for the category
            $categoryImagePath = asset('assets/uploads/category/' . $cat->image);
            $categoryDetails['img'] = $categoryImagePath;

            // Add the category details to the category data array
            $categoryData[] = $categoryDetails;
        }

        return response()->json([
            'message' => 'All categories', 
            'category' => $categoryData 
        ], 200);
    }

    function addWishLisht(Request $req) 
    {
        
    }

    function addPropertyReview(Request $req) 
    {
        
    }

    function getPaymentMethod() 
    {
        $payment = PaymentMethod::where([['show_on_mobile', '=', 1]])->get();

        return response()->json([
            'message' => 'Avaliable payment methods', 
            'payment-method' => $payment 
        ], 200);
    }

    function getNearbyProperty(Request $req) 
    {
        try 
        {
            $req->validate([
                'latitude'=>'required',
                'longtitude'=>'required'
            ]);

            
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errors = $e->errors(); // Get all validation errors as an array

            return response()->json([
                'message' => 'Validation failed.', // General message first
                'errors' => $errors // List of individual errors
            ], 422);
        }
    }

    function addReservation(Request $req)
    {
        try 
        {
            $req->validate([
                // 'latitude'=>'required',
                // 'longtitude'=>'required'
            ]);

            return response()->json([
                'message' => 'Sucessfully added new booking'
            ], 200);
            
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errors = $e->errors(); // Get all validation errors as an array

            return response()->json([
                'message' => 'Validation failed.', // General message first
                'errors' => $errors // List of individual errors
            ], 422);
        }

    }

    function bookRide(Request $req)
    {
        try 
        {
            $req->validate([
                // 'latitude'=>'required',
                // 'longtitude'=>'required'
            ]);

            return response()->json([
                'message' => 'Sucessfully added new booking'
            ], 200);
            
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errors = $e->errors(); // Get all validation errors as an array

            return response()->json([
                'message' => 'Validation failed.', // General message first
                'errors' => $errors // List of individual errors
            ], 422);
        }

    }
}

