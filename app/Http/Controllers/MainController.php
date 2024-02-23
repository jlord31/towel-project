<?php

namespace App\Http\Controllers;

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

use Brian2694\Toastr\Facades\Toastr;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['login']);
    }
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

    function countryView() 
    {
        $country = Country::where([['status', '!=', 'deleted']])->get();

        return view("country", compact('country'));
    }

    function saveNewCountry(Request $req) 
    {
        $req->validate([
            'name'=>'required',
            'code'=>'required',
            'img' => 'required',
            'status' => 'required'
        ]);

        if (Country::where('name', $req->input('name'))->exists()) 
        {
            Session::flash('warning', 'country already exsists');
            return back();
        }
        else 
        {

            if($req->file('img')) 
            {
                $fileName = time().'_'.$req->img->getClientOriginalName();
                $filePath = $req->file('img')->move(public_path('assets/uploads/country/flags/'),$fileName);

                $data = $req->all();
                $data['img'] = $fileName; // Modify filename

                $add_new_country = Country::create($data);

                if ($add_new_country) 
                {
                    Session::flash('success', 'successfully added a new country');
                    return back();
                } 
                else 
                {
                    Session::flash('error', 'Error occurred when tring to add a new country');
                    return back();
                }
            }

        }
    }

    function loadCountryDetails($id) 
    {
        $item = Country::findOrFail($id);

        return response()->json(['status' => 'success', 'data' => $item]); 
    }

    function updateCountry(Request $req) 
    {
        // Retrieve the country model based on the submitted ID
        $country = Country::findOrFail($req->input('id'));

        if($req->file('img_edit')) 
        {
            // Get the old image path
            $oldImagePath = public_path('assets/uploads/country/flags/' . $country->img);

            // Delete the old image if it exists
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $fileName = time().'_'.$req->img_edit->getClientOriginalName();
            $filePath = $req->file('img_edit')->move(public_path('assets/uploads/country/flags/'),$fileName);

            $country->img = $fileName;
        }

        // Update specific attributes with the validated data
        $country->name = $req->input('name_edit');
        $country->code = $req->input('code_edit');
        $country->status = $req->input('status_edit');
        
        // Save the updated university model
        $save = $country->save();

        if ($save) 
        {
            return response()->json(['status' => 'success', 'data' => 'Successfully updated country data']);
        } 
        else 
        {
            return response()->json(['status' => 'error', 'data' => 'Error occurred when trying to update country data. Please try again later']);
        }
    }

    function deleteCountry($id) 
    {
        $item = Country::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted country']);
    }

    function categoryView() 
    {
       
        $category = Category::where([['status', '!=', 'deleted']])->get();

        return view("category", compact('category'));
    }

    function saveNewCategory(Request $req) 
    {
        $req->validate([
            'title'=>'required',
            'img' => 'required',
            'status' => 'required'
        ]);

        if (Category::where('title', $req->input('title'))->exists()) 
        {
            Session::flash('warning', 'category already exsists');
            return back();
        }
        else 
        {

            if($req->file('img')) 
            {
                $fileName = time().'_'.$req->img->getClientOriginalName();
                $filePath = $req->file('img')->move(public_path('assets/uploads/category/'),$fileName);

                $data = $req->all();
                $data['img'] = $fileName; // Modify filename

                $add_new_category = Category::create($data);

                if ($add_new_category) 
                {
                    Session::flash('success', 'successfully added a new category');
                    return back();
                } 
                else 
                {
                    Session::flash('error', 'Error occurred when tring to add a new category');
                    return back();
                }
            }

        }
    }

    function loadCategoryDetails($id) 
    {
        $item = Category::findOrFail($id);

        return response()->json(['status' => 'success', 'data' => $item]); 
    }

    function updateCategory(Request $req) 
    {
        // Retrieve the category model based on the submitted ID
        $category = Category::findOrFail($req->input('id'));

        if($req->file('img_edit')) 
        {
            // Get the old image path
            $oldImagePath = public_path('assets/uploads/category/' . $category->img);

            // Delete the old image if it exists
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $fileName = time().'_'.$req->img_edit->getClientOriginalName();
            $filePath = $req->file('img_edit')->move(public_path('assets/uploads/category/'),$fileName);

            $category->img = $fileName;
        }

        // Update specific attributes with the validated data
        $category->title = $req->input('title_edit');
        $category->status = $req->input('status_edit');
        
        // Save the updated category model
        $save = $category->save();

        if ($save) 
        {
            return response()->json(['status' => 'success', 'data' => 'Successfully updated category data']);
        } 
        else 
        {
            return response()->json(['status' => 'error', 'data' => 'Error occurred when trying to update category data. Please try again later']);
        }
    }

    function deleteCategory($id) 
    {
        $item = Category::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted category']);
    }

    function couponView() 
    {
       
        $coupon = Coupon::where([['status', '!=', 'deleted']])->get();

        return view("coupon", compact('coupon'));
    }

}
