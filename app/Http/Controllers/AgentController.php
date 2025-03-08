<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{   
    public function index()
    {
        // Get the agent's ID from the session
        $user = session('user');
        $agentId = $user->id;

        // Get the number of tickets assigned to the agent
        $createdTicketsCount = Ticket::where('agent_id', $agentId)->count();
        $openTickets = Ticket::where('agent_id', $agentId)->where('status', 'open')->count();
        $resolvedTickets = Ticket::where('agent_id', $agentId)->where('status', 'resolved')->count();
        $closedTickets = Ticket::where('agent_id', $agentId)->where('status', 'closed')->count();

        // Get the ticket creation statistics for the chart (per month)
        $monthlyTickets = Ticket::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->where('agent_id', $agentId)
            ->whereYear('created_at', now()->year)  // Filter tickets by the current year
            ->groupBy('month')
            ->pluck('count', 'month')->toArray();

        
        $monthlyTickets = array_merge(array_fill(1, 12, 0), $monthlyTickets);

        // Pass the data to the view
        return view('agent.dashboard', compact(
            'createdTicketsCount',
            'openTickets',
            'resolvedTickets',
            'closedTickets',
            'monthlyTickets'
        ));
    }


    
    public function showTickets()
    {
        $user = session('user');
        $agentId = $user->id;

        // Get the tickets assigned to the agent with customer and department relationships
        $tickets = Ticket::with(['customer', 'department'])
            ->where('agent_id', $agentId)
            ->paginate(10); // Paginate the results to avoid loading too many tickets at once

        // Pass the tickets to the view
        return view('agent.tickets', compact('tickets'));
    }


    public function agentlist()
    {
        $agents = Agent::with('department')->paginate(10);

        $departments = Department::all();

        return view('supervisor.agent_list', compact('agents', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('supervisor.create_agent', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'password' => 'required|string|min:6|confirmed', 
            'department_id' => 'required|exists:departments,id',
        ]);

        Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent created successfully!');
    }
}
