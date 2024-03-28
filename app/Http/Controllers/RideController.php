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
use App\Models\Ride;

class RideController extends Controller
{
    //
    function getRide()
    {
        $rides = Ride::where([['status', '!=', 'deleted']])->get();

        return view("manage-ride", compact('rides'));
    }

    function addRide(Request $req)
    {
        try 
        {
            $req->validate([
                'model'=>'required',
                'color' => 'required',
                'image' => 'required',
                'actual_price_per_day' => 'required|int',
                'customer_price_per_day' => 'required|int',
                'airport_park_pickup_actual_price' => 'required|int',
                'airport_park_pickup_customer_price' => 'required|int',
                'status' => 'required'
            ]);
            
            if($req->file('image')) 
            {
                $fileName = time().'_'.$req->image->getClientOriginalName();
                $filePath = $req->file('image')->move(public_path('assets/uploads/ride/'),$fileName);

                $profit_price_per_day = $req->customer_price_per_day - $req->actual_price_per_day;
                $profit_airport_park = $req->airport_park_pickup_customer_price - $req->airport_park_pickup_actual_price;

                $data = $req->all();
                $data['image'] = $fileName; // Modify filename
                $data['company_profit_per_day'] = $profit_price_per_day;
                $data['airport_park_pickup_company_profit'] = $profit_airport_park;

                $add_new_ride = Ride::create($data);

                if ($add_new_ride) 
                {
                    Session::flash('success', 'successfully added a new ride');
                    return back();
                } 
                else 
                {
                    Session::flash('error', 'Error occurred when tring to add a new ride');
                    return back();
                }
            }
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errorMessage = $e->getMessage(); // Get the error message
            Session::flash('error', $errorMessage);
            return back();
        }
    }

    function deleteRide($id)
    {
        $item = Ride::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted ride']);
    }

    function rideUnavailableDateView() 
    {
        $ride = Ride::where([['status', '!=', 'deleted']])->get();

        $unavaliable = PropertyUnavailableDate::where([['status', '!=', 'deleted']])->get();

        return view("unavaliable-dates", compact('property','unavaliable'));
    }

    function storeRideUnavailableDate(Request $req) 
    {
        
    }

    function updateRideUavaliabilityStatus(Request $req) 
    {
        
    }

    function deleteRideUnavaliableDate($id) 
    {
        
    }
}
