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

    function saveNewCoupon(Request $req)
    {

        try 
        {
            $validatedData = $req->validate([
                'title'=>'required',
                'coupon_code'=> 'required',
                'value'=> 'required|numeric|min:0',
                'total_use_allowed'=> 'required|numeric|min:0',
                'expiration_date'=> 'required',
                'status'=> 'required',
            ]);

            // when validation passes check if coupon already exsists

            if (Coupon::where('coupon_code', $req->input('coupon_code'))->exists()) 
            {
                Session::flash('warning', 'Coupon Code already exsists');
                return back();
            }
            else 
            {
                if($req->file('img')) 
                {
                    $fileName = time().'_'.$req->img->getClientOriginalName();
                    $filePath = $req->file('img')->move(public_path('assets/uploads/coupon/'),$fileName);

                    $data = $req->all();
                    $data['img'] = $fileName; // Modify filename
    
                    $coupon = Coupon::create($data);

                    if ($coupon) 
                    {
                        Session::flash('success', 'successfully created new coupon');
                        return back();
                    } 
                    else 
                    {
                        Session::flash('error', 'Error occurred when tring to create new coupon');
                        return back();
                    }
                }
                else 
                {
                    $coupon = Coupon::create($req->all());

                    if ($coupon) 
                    {
                        Session::flash('success', 'successfully created new coupon');
                        return back();
                    } 
                    else 
                    {
                        Session::flash('error', 'Error occurred when tring to create new coupon');
                        return back();
                    }
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

    function loadCouponDetails($id) 
    {
        $item = Coupon::findOrFail($id);

        return response()->json(['status' => 'success', 'data' => $item]); 
    }

    function updateCoupon(Request $req) 
    {
        // Retrieve the coupon model based on the submitted ID
        $coupon = Coupon::findOrFail($req->input('id'));

        if($req->file('img_edit')) 
        {
            // Get the old image path
            $oldImagePath = public_path('assets/uploads/coupon/' . $coupon->img);

            // Delete the old image if it exists
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $fileName = time().'_'.$req->img_edit->getClientOriginalName();
            $filePath = $req->file('img_edit')->move(public_path('assets/uploads/coupon/'),$fileName);

            $coupon->img = $fileName;
        }

        // Update specific attributes with the validated data
        $coupon->title = $req->input('title_edit');
        $coupon->value = $req->input('value_edit');

        $coupon->total_use_allowed = $req->input('total_use_allowed_edit');
        $coupon->expiration_date = $req->input('expiration_date_edit');
        $coupon->description = $req->input('description_edit');
        $coupon->status = $req->input('status_edit');
        
        // Save the updated coupon model
        $save = $coupon->save();

        if ($save) 
        {
            return response()->json(['status' => 'success', 'data' => 'Successfully updated coupon data']);
        } 
        else 
        {
            return response()->json(['status' => 'error', 'data' => 'Error occurred when trying to update coupon data. Please try again later']);
        }
    }

    function deleteCoupon($id) 
    {
        $item = Coupon::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted coupon']);
    }

    function paymentView()
    {
        $payment = PaymentMethod::where([['status', '!=', 'deleted']])->get();

        return view("payment", compact('payment'));  
    }

    function loadPaymentDetails($id) 
    {
        $item = PaymentMethod::findOrFail($id);

        return response()->json(['status' => 'success', 'data' => $item]); 
    }

    function updateMobilePaymentStatus($id) 
    {
     
        $item = PaymentMethod::findOrFail($id);
        
        // // Get the current status from the database
        $currentStatus = PaymentMethod::where('id', $item->id)->value('show_on_mobile');

        // // Update the status based on its current value
        if ($currentStatus == 1) 
        {
            PaymentMethod::where('id', $item->id)->update(['show_on_mobile' => 0]);
            $newStatus = 0;
        } 
        else 
        {
            PaymentMethod::where('id', $item->id)->update(['show_on_mobile' => 1]);
            $newStatus = 1;
        }

        // Return a JSON response indicating success or failure
        return response()->json(['status' => 'success', 'new_status' => $newStatus]);
       
    }

    function updatePayment(Request $req) 
    {
        // Retrieve the PaymentMethod model based on the submitted ID
        $payment = PaymentMethod::findOrFail($req->input('id'));

        if($req->file('img_edit')) 
        {
            // Get the old image path
            $oldImagePath = public_path('assets/images/payment/' . $payment->img);

            // Delete the old image if it exists
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $fileName = time().'_'.$req->img_edit->getClientOriginalName();
            $filePath = $req->file('img_edit')->move(public_path('assets/images/payment/'),$fileName);

            $payment->img = $fileName;
        }

        // Update specific attributes with the validated data
        $payment->title = $req->input('title_edit');
        $payment->show_on_mobile = $req->input('show_on_mobile_edit');

        $payment->description = $req->input('description_edit');
        $payment->status = $req->input('status_edit');
        
        // Save the updated payment model
        $save = $payment->save();

        if ($save) 
        {
            return response()->json(['status' => 'success', 'data' => 'Successfully updated payment data']);
        } 
        else 
        {
            return response()->json(['status' => 'error', 'data' => 'Error occurred when trying to update payment data. Please try again later']);
        }
    }

    function deletePayment($id) 
    {
        $item = PaymentMethod::findOrFail($id);
        $item->update(['status' => 'deleted']);

        return response()->json(['message' => 'Successfully deleted Payment Method']);
    }

}
