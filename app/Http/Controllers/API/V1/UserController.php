<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Report;

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
}

