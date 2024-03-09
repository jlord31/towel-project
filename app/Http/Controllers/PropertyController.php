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

        return view("property", compact('categories', 'countries', 'facilities'));  
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
        //
        //return response()->json(['status' => 'success']);

        // Handle file uploads
        $uploadedFiles = [];
        if ($req->hasFile('files')) {
            foreach ($req->file('files') as $file) {
                $filename = $file->getClientOriginalName();
                $uploadedFiles[] = $filename;
                // Move the file to a desired location if needed
                // $file->move('path/to/destination', $filename);
            }
        }

        // You can also handle other form data if needed
        $title = $req->input('title');
        $status = $req->input('status');

        // Return JSON response with file names
        return response()->json([
            'uploaded_files' => $uploadedFiles,
            'title' => $title,
            'status' => $status,
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
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
