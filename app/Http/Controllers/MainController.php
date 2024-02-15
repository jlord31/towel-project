<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            toastr()->error('Invalid username/password');
            return back();

            // Toastr::error('Authentication failed');
            // return redirect()->back()->withInput();
        }
        else
        {
            $log_user_in = Auth::guard('admin')->attempt($credentials);
            if (!$log_user_in) 
            {
                toastr()->error('Authentication failed');
                return back();
            } else 
            {
                toastr()->success('Login Successful');
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
}
