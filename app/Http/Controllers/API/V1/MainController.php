<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\PropertyUnavailableDate;

class MainController extends Controller
{
    function property() 
    {
        $property = Property::where([['status', '!=', 'deleted']])->get();

        return response()->json(['message' => 'User profile data', 'data' => $property], 200);
    }
}
