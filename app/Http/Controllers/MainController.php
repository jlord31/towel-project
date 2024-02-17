<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Admin;

use Brian2694\Toastr\Facades\Toastr;

class MainController extends Controller
{
    //
    public function login(Request $req)
    {
        $req->validate([
            'username'=>'required',
            'password'=>'required|min:4'
        ]);

        $credentials = $req->only('username', 'password');

        // dd($credentials);

        $userlog = Admin::where(['username'=>$req->username])->first();
        
        if (!$userlog || !Hash::check($req->password, $userlog->password)) 
        {
            Session::flash('error', 'Invalid username/password');
            return back();
        }
        else
        {
            $log_user_in = Auth::guard('admin')->attempt($credentials);
            if (!$log_user_in) 
            {
                Session::flash('error', 'Authentication failed');
                return back();
            } else 
            {
                
                Session::flash('success', 'Login Successful');
                return redirect()->route('dashboard');
                $req->session()->put("admin_user",$userlog);
                // return Redirect('admin/dashboard');
            }
            
            
        }
    }

    function dashboard() 
    {
        return view("dashboard");
    }

    function changePasswordView()
    {
        return view("change-password");

    }

    function changePassword(Request $req)
    {
        if (Auth::guard('admin')->check()) 
        {
            $req->validate([
                'password'=>'required|min:4|confirmed',
                'password_confirmation'=>'required|min:4'
            ]);

            $new_password = Hash::make($req->password);

            $userId = Auth::guard("admin")->user()->id;

            $update_password = Admin::where('id', $userId)->update(['password' => $new_password]);

            if($update_password)
            {
                return redirect()->back()->with('success', 'Password updated successfully');
            }
            else
            {
                return redirect()->back()->withErrors([ 'Unable to update password']);
            }
        }
    }
}
