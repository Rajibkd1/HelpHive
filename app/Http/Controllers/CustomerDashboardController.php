<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerDashboardController extends Controller
{


    public function index()
    {

        // Get the user from the session
        $user = session('user');

        // Get the count of created tickets
        $createdTicketsCount = Ticket::where('customer_id', $user->id)->count();

        // Get the count of tickets by status
        $openTickets = Ticket::where('customer_id', $user->id)->where('status', 'open')->count();
        $inProgressTickets = Ticket::where('customer_id', $user->id)->where('status', 'in-progress')->count();
        $resolvedTickets = Ticket::where('customer_id', $user->id)->where('status', 'resolved')->count();
        $closedTickets = Ticket::where('customer_id', $user->id)->where('status', 'closed')->count();

        // Get ticket creation statistics for graph (per month)
        // Get ticket creation statistics for graph (per month)
        $monthlyTickets = Ticket::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->where('customer_id', $user->id)
            ->whereNotNull('created_at')  // Exclude tickets with NULL created_at
            ->whereYear('created_at', now()->year)  // Filter tickets by the current year
            ->whereMonth('created_at', now()->month)  // Filter tickets by the current month
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray(); // Ensure this is always an array

        // Ensure all months are represented (even if no tickets for some months)
        $monthlyTickets = array_merge(array_fill(1, 12, 0), $monthlyTickets);





        // Return the view with data
        return view('customer.customer-dashboard', compact(
            'createdTicketsCount',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets',
            'monthlyTickets' // Contains the current month's ticket count
        ));
    }

    // // Apply the 'role:customer' middleware to this controller method
    // public function index()
    // {
    //     $user = session('user'); // Retrieve the user data from session
    //     return view('customer.customer-dashboard', compact('user')); // Ensure view name matches file path
    // }
    // // CustomerDashboardController.php


    public function showProfile()
    {
        $user = session('user');  // Retrieve the user data from session

        return view('customer.profile', compact('user'));  // Pass the user data to the profile view
    }

    public function editProfile()
    {
        $user = session('user');
        return view('customer.profile-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Ensure the user is logged in
        $user = session('user');


        if (!$user) {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login')->with('error', 'Please log in to update your profile');
        }

        // Validate the input
        $validated = $request->validate([
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'gender' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'mobile_number' => 'nullable|string|max:255',
        ]);

        // Update the editable fields
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->mobile_number = $request->mobile_number;

        // Handle profile picture upload if present
        if ($request->hasFile('profile_picture')) {
            // Get the uploaded profile picture
            $file = $request->file('profile_picture');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $filename);

            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            // Update the user's profile picture path
            $user->profile_picture = str_replace('public/', '', $path);  // Store the relative path 'profile_pictures/filename'

            // Save the updated user information
            $user->save();
        }
        // Optionally, update the session with the new user data
        session(['user' => $user]);

        // Redirect to the profile page with success message
        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }





    public function showTickets()
    {
        $user = session('user');  // Retrieve the logged-in user from the session

        // Ensure the user is logged in
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in to view your tickets.']);
        }

        // Fetch tickets related to the logged-in user (customer_id) and paginate
        $tickets = Ticket::where('customer_id', $user->id)->paginate(7);

        // Pass the tickets to the view
        return view('customer.tickets', compact('tickets'));
    }


    public function showTicketDetails($ticketId)
    {
        // Retrieve the logged-in user from session
        $user = session('user');

        // Get the ticket by ID
        $ticket = Ticket::with(['responses', 'uploads'])->findOrFail($ticketId); // Eager load responses and uploads

        // Return the ticket details view
        return view('customer.ticket.details', compact('ticket', 'user'));
    }


    // Method to show the ticket creation form
    public function createTicket()
    {
        // Fetch all departments for the dropdown
        $departments = Department::all();

        // Return the ticket creation view with departments data
        return view('customer.ticket.create', compact('departments'));
    }

    // Method to store the ticket after form submission
    public function storeTicket(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'department' => 'required|exists:departments,id', // Ensure that the department exists
            'body' => 'required|string', // Ticket body is required
            'file' => 'nullable|mimes:jpg,png,pdf,doc,docx,txt|max:10240', // Validate file type and size
        ]);

        // Retrieve the logged-in user from the session
        $user = session('user'); // This will give you the user object stored in the session

        // Check if the user exists in the session
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in to create a ticket.']);
        }

        // Create the ticket record
        $ticket = Ticket::create([
            'title' => $validated['subject'],
            'description' => $validated['body'],
            'department_id' => $validated['department'],
            'customer_id' => $user->id,  // Use the logged-in user's ID
            'status' => 'open',
            'priority' => 'medium', // You can adjust the priority if necessary
        ]);

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            // Store the file in the 'public/uploads' directory (relative to 'storage/app')
            $path = $file->storeAs('public/uploads', $filename);  // This will store the file in 'storage/app/public/uploads'

            // Save the file path in the uploads table
            Upload::create([
                'file_path' => str_replace('public/', '', $path), // Store relative path 'uploads/filename'
                'ticket_id' => $ticket->id,
            ]);
        }

        // Redirect back with success message
        return redirect()->route('customer.dashboard')->with('success', 'Ticket created successfully!');
    }
}
