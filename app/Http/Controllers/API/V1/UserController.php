<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

                return response()->json(['message' => 'User profile data', 'data' => $userlog], 200);
            }
            

            
        } 
        catch (UnauthorizedHttpException $e) 
        {
            return response()->json(['error' => 'Invalid token.'], 401);
        }
        
    }
}

