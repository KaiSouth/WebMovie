<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{

   public function index()
   {
       return view('auth.cuslogin');
   }
   public function index1()
   {
       return view('auth.cusregister');
   }
   public function loginCustomer(Request $request)
   {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('customer')
                    ->where('email', $validatedData['email'])
                    ->first();

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            Auth::loginUsingId($user->id);
            return redirect()->route('homepage');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function checkCustomer(Request $request) {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('customer')
                    ->where('email', $validatedData['email'])
                    ->first();

        if ($user && Hash::check($validatedData['password'], $user->password))
        {
            Auth::guard('customer')->loginUsingId($user->id, true);
            return redirect()->route('homepage')->with('success', 'Đăng nhập thành công!');
        }
        else
        {
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác.',
            ]);
        }
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->user();

        // Tìm hoặc tạo mới người dùng dựa trên google_id hoặc email
        $user = DB::table('customer')->where('google_id', $googleUser->id)->first();

        if (!$user) {
            // Nếu người dùng không tồn tại, tìm theo email
            $user = DB::table('customer')->where('email', $googleUser->email)->first();

            if (!$user) {
                // Nếu email cũng không tồn tại, tạo mới người dùng
                $userId = DB::table('customer')->insertGetId([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => '', // bạn có thể để trống hoặc mã hóa một giá trị nào đó
                ]);
                // Tìm user đã tạo
                $user = DB::table('customer')->where('id', $userId)->first();
            } else {
                // Nếu email đã tồn tại, liên kết google_id và cập nhật user
                DB::table('customer')
                    ->where('id', $user->id)
                    ->update(['google_id' => $googleUser->id]);
            }
        }

        Auth::guard('customer')->loginUsingId($user->id, true);

        return redirect()->route('homepage');
    }


    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = DB::table('customer')->where('facebook_id', $facebookUser->id)->first();

        if (!$user) {
            $user = DB::table('customer')->where('email', $facebookUser->email)->first();

            if (!$user) {
                $userId = DB::table('customer')->insertGetId([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => '',
                ]);
                $user = DB::table('customer')->where('id', $userId)->first();
            } else {
                DB::table('customer')
                    ->where('id', $user->id)
                    ->update(['facebook_id' => $facebookUser->id]);
            }
        }

        Auth::loginUsingId($user->id, true);

        return redirect()->route('homepage');
    }
    public function checkRegister(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customer',
            'password' => 'required|string|min:3|confirmed',
        ];

        // Create a validator instance and apply validation rules
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Prepare customer's data for insertion
        $customerData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encryption of password
        ];

        // Insert customer's data into 'customer' table and retrieve the ID
        $customerId = DB::table('customer')->insertGetId($customerData);

        // Check if customer ID is created
        if ($customerId) {
            // Flash a success message to the session
            $request->session()->flash('success', 'Registration successful. You can now login.');

            // Redirect to login page with success message
            return redirect('/loginCus');
        } else {
            // Redirect back if insertion fails
            return redirect()->back()->with('error', 'Registration failed, please try again.');
        }
    }


}
