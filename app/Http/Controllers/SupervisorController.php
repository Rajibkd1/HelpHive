<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Http\Request;

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




    public function cannedReplies()
    {
        // Return the view for canned replies
        return view('supervisor.canned_replies');
    }

    public function departments()
    {
        // Return the view for departments
        return view('supervisor.departments');
    }

    public function labels()
    {
        // Return the view for labels
        return view('supervisor.labels');
    }

    public function statuses()
    {
        // Return the view for statuses
        return view('supervisor.statuses');
    }

    public function priorities()
    {
        // Return the view for priorities
        return view('supervisor.priorities');
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
