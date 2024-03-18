<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Report;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\PropertyUnavailableDate;
use App\Models\WishList;

class UserController extends Controller
{
    //
    function register(Request $req)
    {
        try 
        {
            // validate registration payload
            $validatedData = $req->validate([

                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'ccode' => 'required',
                'mobile' => 'required',
            ]);

            // create new user
            $user = User::create([
                'name' => $req->name,
                'password' => Hash::make($req->password),
                'email' => $req->email,
                'ccode' => $req->ccode,
                'mobile' => $req->mobile,
                'refercode' => generateReferralCode($req->name),
                'parentcode' => '',
                'pro_pic' => '',
                'status' => 'active',
            ]);

            if ($user) 
            {
                return response()->json(['status' => 201, 'message' => 'User successfully created']);
            } 
            else 
            {
                return response()->json(['status' => 400, 'message' => 'Error occurred when creating new User']);
            }
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errors = $e->errors(); // Get all validation errors as an array

            return response()->json([
                'status' => 422,
                'message' => 'Validation failed.', // General message first
                'errors' => $errors // List of individual errors
            ]);
        }

    }

    function login(Request $req)
    {
        try 
        {
            $req->validate([
                'email' => 'required|email',
                'password'=>'required|min:6'
            ]);
    
            $credentials = $req->only('email', 'password');

            // attempt login
            $auth = Auth::attempt($credentials);
    
            
            if ($auth) 
            {
                $user = Auth::user();

                $token = $user->createToken('towel-api-login-token')->accessToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'Successful login', 
                    'token' => $token 
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 205,
                    'message' => 'Invalid login details'
                ]);
            }    
                
        } 
        catch (ValidationException $e) 
        {
            // Handle validation errors
            $errors = $e->errors(); // Get all validation errors as an array

            return response()->json([
                'status' => 422,
                'message' => 'Validation failed.', // General message first
                'errors' => $errors // List of individual errors
            ]);
        }
    }

    function logout()
    {
       $user = auth()->user()->token()->revoke();

       if ($user) 
        {
            return response()->json(['message' => 'User successfully logged out.'], 200);
        } 
        else 
        {
            return response()->json(['message' => 'Error occurred when trying to log user out.'], 422);
        }
       
    }

    function profile()
    {
        try 
        {
            $user = Auth::guard('api')->user();

            return response()->json(['message' => 'User profile data', 'data' => $user], 200);
        } 
        catch (UnauthorizedHttpException $e) 
        {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
        
    }

    function updateProfile(Request $req)
    {
        try 
        {
            $user = Auth::guard('api')->user();

            if (!$user) 
            {
                return response()->json(['message' => 'Unauthorized user'], 422);
            } 
            else 
            {

                $userId = $user->id;

                $userlog = User::where(['id'=>$userId])->first();

                $userlog->name = $req->name ? $req->name : $userlog->name; 
                $userlog->email = $req->email ? $req->email : $userlog->email; 

                if($req->file('pro_pic')) 
                {
                    // Get the old image path
                    $oldImagePath = public_path('assets/uploads/user/profile/' . $req->pro_pic);

                    // Delete the old image if it exists
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }

                    $fileName = time().'_'.$req->pro_pic->getClientOriginalName();
                    $filePath = $req->file('pro_pic')->move(public_path('assets/uploads/user/profile'),$fileName);
    
                    $userlog->pro_pic = $fileName;
                }

                $save = $userlog->save();

                if ($save) 
                {
                    return response()->json(['message' => 'User profile successfully update'], 200);
                } 
                else 
                {
                    return response()->json(['message' => 'Unable to update user profile'], 422);
                }
            
            }
            
        } 
        catch (UnauthorizedHttpException $e) 
        {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
        
    }

    function changePassword(Request $req)
    {
        try 
        {
            $req->validate([
                'password'=>'required|min:4|confirmed',
                'password_confirmation'=>'required|min:4'
            ]);

            $user = Auth::guard('api')->user();

            $new_password = Hash::make($req->password);

            $userId = $user->id;

            $update_password = User::where('id', $userId)->update(['password' => $new_password]);

            if($update_password)
            {
                return response()->json(['message' => 'Password changed successfully'], 200);
            }
            else
            {
                return response()->json(['message' => 'Unable to update password'], 422);
            }
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

    function userReport(Request $req)
    {
        try 
        {

            $req->validate([
                'message'=>'required',
                'property_id'=>'required'
            ]);

            $user = Auth::guard('api')->user();

            $data = new Report();
            $data->user_id = $user->id;
            $data->property_id = $req->property_id;
            $data->message = $req->message;
            $data->status = 'unresolved';

            $save = $data->save();

            if($save)
            {
                return response()->json(['message' => 'Successfully added report'], 200);
            }
            else
            {
                return response()->json(['message' => 'Unable to add report'], 422);
            }
            
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

    function addWishList(Request $req) 
    {
        try 
        {
            $data = $req->validate([
                'user_id'=>'required',
                'property_id'=>'required'
            ]);

            $exsists = WishList::where([["user_id", "=", $req->user_id], ["property_id", "=", $req->property_id]])->first();

            if (!$exsists) 
            {
                $add_new_wishList = WishList::create($data);

                if ($add_new_wishList) 
                {
                    return response()->json([
                        'message' => 'Sucessfully added new wishList'
                    ], 200);
                } 
                else 
                {
                    return response()->json([
                        'message' => 'Error occurred when trying to add new wishList'
                    ], 422);
                }
            } 
            else 
            {
                return response()->json([
                    'message' => 'Property WishList already exsists!'
                ], 409);
            }
            
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

    function getWishList() 
    {
        $user = Auth::guard('api')->user();

        // Get the user's wish list
        $userWishList = WishList::where('user_id', $user->id)->pluck('property_id');

        // Retrieve properties based on the user's wish list
        $properties = Property::whereIn('id', $userWishList)
        ->where('status', 'active')
        ->with(['country:id,name', 'category:id,title']) // Eager load only necessary columns
        ->get();

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

            // Add country and category names to the property details
            $propertyDetails['country'] = $property->country->name;
            $propertyDetails['category'] = $property->category->title;

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
            'message' => 'User property Wishlist ',
            'properties' => $propertyData,
        ];

        // Return API response as JSON
        return response()->json($response, 200);
           
    }

    function deleteWishList($id) 
    {
        try 
        {
            $wish = WishList::findorFail($id);

            $user = Auth::guard('api')->user();

            $del = $wish->where([['user_id', '=', $user->id]])->delete();

            if ($del) 
            {
                return response()->json([
                    'message' => 'Sucessfully removed property from wishList'
                ], 200);
            } 
            else 
            {
                return response()->json([
                    'message' => 'Error occurred when trying to remove property from wishList'
                ], 422);
            }
        } 
        catch (ModelNotFoundException $e) 
        {
            return response()->json([
                'message' => 'Failed to find specified wishlist ID' , // General message first
            ], 422);
        }
        
    }

    function addRide(Request $req) 
    {
        
    }

    function getRide() 
    {
        
    }
}

