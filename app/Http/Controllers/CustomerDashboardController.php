<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerDashboardController extends Controller
{


    public function index()
    {
        $user = session('user');

        $createdTicketsCount = Ticket::where('customer_id', $user->id)->count();

        $openTickets = Ticket::where('customer_id', $user->id)->where('status', 'open')->count();
        $inProgressTickets = Ticket::where('customer_id', $user->id)->where('status', 'in-progress')->count();
        $resolvedTickets = Ticket::where('customer_id', $user->id)->where('status', 'resolved')->count();
        $closedTickets = Ticket::where('customer_id', $user->id)->where('status', 'closed')->count();

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

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $filename);

            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $user->profile_picture = str_replace('public/', '', $path);  // Store the relative path 'profile_pictures/filename'

            $user->save();
        }
        session(['user' => $user]);

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }





    public function showTickets()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in to view your tickets.']);
        }

        $tickets = Ticket::where('customer_id', $user->id)->paginate(7);

        return view('customer.tickets', compact('tickets'));
    }


    public function showTicketDetails($ticketId)
    {
        $user = session('user');

        $ticket = Ticket::with(['responses', 'uploads'])->findOrFail($ticketId);

        return view('customer.ticket.details', compact('ticket', 'user'));
    }


    public function createTicket()
    {
        $departments = Department::all();
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

        $user = session('user'); // This will give you the user object stored in the session

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

    public function storeReply(Request $request, Ticket $ticket)
    {
        // Validate the request
        $request->validate([
            'customer_response' => 'required|string|max:10000',
            'customer_attachments' => 'nullable|array|max:5', // Only allow up to 5 files
            'customer_attachments.*' => 'file|max:10240', // Max file size: 10MB
            'priority' => 'nullable|string|in:low,medium,high,urgent',
            'category' => 'nullable|string|in:general,technical,billing,feature',
        ]);

        // Get the current user (customer) from the session or authentication
        $user = session('user'); // This assumes the customer is stored in session
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in as a customer.');
        }
        $customer_id = $user->id;

        // Prepare the file path if any files were uploaded
        $filePaths = [];
        if ($request->hasFile('customer_attachments')) {
            foreach ($request->file('customer_attachments') as $file) {
                // Store each file
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/uploads', $filename);
                $filePaths[] = str_replace('public/', '', $path); // Store the relative file path
            }
        }

        // Create the ticket response
        // Create the ticket response
        TicketResponse::create([
            'response' => $request->input('customer_response'),
            'ticket_id' => $ticket->id,
            'customer_id' => $customer_id, // For customer replies
            'agent_id' => null, // Set agent_id to null for customer replies
            'file_path' => implode(',', $filePaths), // Multiple files stored as comma-separated paths
        ]);
        // Return a response (e.g., redirect back or send a success response)
        return redirect()->route('cus-ticket.details', $ticket->id)->with('success', 'Your reply has been submitted successfully.');
    }
}
