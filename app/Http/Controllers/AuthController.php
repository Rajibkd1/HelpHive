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
use App\Models\Agent;
use App\Models\Supervisor;

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
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Try to find the user in each table and authenticate
        $user = null;
        $role = null;

        // Check for customer
        $user = Customer::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user, 'role' => 'customer']);
            return redirect()->route('customer.dashboard');
        }

        // Check for agent
        $user = Agent::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user, 'role' => 'agent']);
            return redirect()->route('agent.dashboard');
        }

        // Check for supervisor
        $user = Supervisor::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user, 'role' => 'supervisor']);
            return redirect()->route('supervisor.dashboard');
        }

        // If no user found, return with error
        return back()->withErrors(['email' => 'Invalid login credentials']);
    }


    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

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
        $role = session('role'); // Get the role from session

        return view('dashboard', ['role' => $role]); // Pass role to the dashboard
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
