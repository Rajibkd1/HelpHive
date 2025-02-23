<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\OtpMail;


class AuthController extends Controller
{
    // Show login/register page
    public function showAuthForm()
    {
        return view('auth');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user using Laravel's default Auth
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, redirect to dashboard
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // Authentication failed, return with error
        return back()->withErrors(['email' => 'Invalid login credentials'])->with('error', 'Invalid credentials!');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',  // Validate against customers table
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log in the customer after registration
        Auth::login($customer);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');  // Redirect to the login page
    }

    // Show the dashboard
    public function dashboard()
    {
        // Use Auth::check() to check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }

        $customer = Auth::user();  // Get the authenticated customer
        return view('dashboard', ['customer' => $customer]);  // Pass customer data to the view
    }

    // Send OTP to the user's email
    public function sendOtp(Request $request)
    {
        // Validate email format
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email already exists in the customers table
        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            return response()->json(['success' => false, 'message' => 'Email already exists, please log in.']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP and email in the session
        Session::put('otp', $otp);
        Session::put('otp_email', $request->email);

        try {
            // Send OTP email using Laravel's Mail facade
            Mail::to($request->email)->send(new OtpMail($otp));
            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while sending OTP.']);
        }
    }

    // Verify the OTP entered by the user
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email',
        ]);

        // Check if the OTP matches the one stored in the session
        if ($request->otp == Session::get('otp') && $request->email == Session::get('otp_email')) {
            return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }

}
