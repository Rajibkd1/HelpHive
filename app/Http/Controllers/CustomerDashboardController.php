<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    // Apply the 'role:customer' middleware to this controller method
    public function index()
    {
        return view('customer.customer-dashboard');  // Return the customer dashboard view
    }
}
