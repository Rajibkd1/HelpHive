<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\Upload;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    // Apply the 'role:customer' middleware to this controller method
    public function index()
    {
        $user = session('user'); // Retrieve the user data from session
        return view('customer.customer-dashboard', compact('user')); // Ensure view name matches file path
    }
    // CustomerDashboardController.php


    public function showTickets()
    {
        // Retrieve the logged-in user from the session
        $user = session('user');

        // Check if user exists in the session
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in to view your tickets.']);
        }

        // Fetch tickets related to the logged-in user (customer_id) and paginate
        $tickets = Ticket::where('customer_id', $user->id)->paginate(7);  // Paginate 7 tickets per page

        // Return the view with the tickets
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
