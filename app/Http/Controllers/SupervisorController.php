<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SupervisorController extends Controller
{
    public function dashboard()
    {
        // Get the count of different types of tickets
        $createdTicketsCount = Ticket::count();  // Get total tickets created
        $openTickets = Ticket::where('status', 'open')->count();  // Get count of open tickets
        $resolvedTickets = Ticket::where('status', 'resolved')->count();  // Get count of resolved tickets
        $closedTickets = Ticket::where('status', 'closed')->count();  // Get count of closed tickets

        // Fetch all tickets for supervisor (if needed, pagination can be added)
        $allTickets = Ticket::all();

        // Monthly ticket data for the chart
        $monthlyTickets = Ticket::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')->toArray();

        // Pass the data to the view
        return view('supervisor.dashboard', compact(
            'createdTicketsCount',
            'openTickets',
            'resolvedTickets',
            'closedTickets',
            'allTickets',
            'monthlyTickets'
        ));
    }


    public function showAllTickets()
    {
        $tickets = Ticket::with('customer', 'department', 'agent')->paginate(7);
        $agents = Agent::all();


        return view('supervisor.tickets', compact('tickets', 'agents'));
    }

    public function updatePriority(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'priority' => $request->priority,
        ]);

        return back();
    }

    public function updateAssign(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'agent_id' => $request->agent_id,
        ]);

        return back();
    }

    public function showTicketDetails(Ticket $ticket)
    {
        $tickets = Ticket::with('customer', 'department', 'agent')->paginate(7);

        // Get the list of agents (users with the 'agent' role)
        $agents = Agent::all();

        // Pass ticket and agents to the view
        return view('supervisor.ticket_details', compact('ticket', 'agents'));
    }


    public function statuses()
    {
        // Get the count for each status
        $statusCounts = [
            'open' => Ticket::where('status', 'open')->count(),
            'in-progress' => Ticket::where('status', 'in-progress')->count(),
            'resolved' => Ticket::where('status', 'resolved')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
        ];

        // Pass the status counts to the view
        return view('supervisor.statuses', compact('statusCounts'));
    }


    // Method to display tickets by status
    public function showTicketsByStatus($status)
    {
        $tickets = Ticket::where('status', $status)->paginate(7);
        $agents = Agent::all();

        return view('supervisor.status_tickets', compact('tickets', 'status', 'agents'));
    }


    public function priorities()
    {
        // Define all possible priorities
        $priorities = ['low', 'medium', 'high'];

        // Get the count of tickets for each priority
        $priorityCounts = [];
        foreach ($priorities as $priority) {
            $count = Ticket::where('priority', $priority)->count();
            $priorityCounts[] = ['priority' => $priority, 'count' => $count];
        }

        // Pass the priority counts to the view
        return view('supervisor.priority_tickets', compact('priorityCounts'));
    }

    public function showTicketsByPriority($priority)
    {
        // Validate the priority to avoid invalid values
        $validPriorities = ['low', 'medium', 'high'];
        if (!in_array($priority, $validPriorities)) {
            abort(404);
        }

        // Fetch tickets based on the selected priority
        $tickets = Ticket::where('priority', $priority)->paginate(7);

        $agents = Agent::all();

        // Pass the tickets and the priority to the view
        return view('supervisor.priority_tickets_details', compact('tickets', 'priority', 'agents'));
    }

    public function showDepartments()
    {
        // Get all departments with pagination
        $departments = Department::paginate(10);
        return view('supervisor.departments.index', compact('departments'));
    }

    // Show the form to create a new department
    public function createDepartment()
    {
        return view('supervisor.departments.create');
    }

    // Store a new department
    public function storeDepartment(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|unique:departments,name|max:255',
        ]);

        // Create a new department
        Department::create([
            'name' => $request->name,
        ]);

        // Redirect back to department list with success message
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    // Show the form to edit a department
    public function editDepartment(Department $department)
    {
        return view('supervisor.departments.edit', compact('department'));
    }

    // Update a department
    public function updateDepartment(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $department->id . '|max:255',
        ]);

        $department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    public function cannedReplies()
    {
        // Return the view for canned replies
        return view('supervisor.canned_replies');
    }


    public function labels()
    {
        // Return the view for labels
        return view('supervisor.labels');
    }

    public function users()
    {
        // Return the view for users
        return view('supervisor.users');
    }

    public function userRoles()
    {
        // Return the view for user roles
        return view('supervisor.user_roles');
    }

    public function settings()
    {
        // Return the view for settings
        return view('supervisor.settings');
    }

    public function translations()
    {
        // Return the view for translations
        return view('supervisor.translations');
    }
}
