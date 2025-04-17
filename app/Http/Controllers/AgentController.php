<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\Upload;
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


        // $monthlyTickets = array_merge(array_fill(1, 12, 0), $monthlyTickets);

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

    public function showTicketDetails($ticketId)
    {
        $ticket = Ticket::with(['department', 'customer', 'uploads', 'responses'])->findOrFail($ticketId);
        $agents = Agent::all();  // Get all agents to show in the dropdown for reassignment

        return view('agent.ticket_details', compact('ticket', 'agents'));
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

    public function edit(Agent $agent)
    {
        // Get all departments to show in the select list
        $departments = Department::all();

        return view('supervisor.edit_agent', compact('agent', 'departments'));
    }


    public function update(Request $request, Agent $agent)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $agent->id,
            'password' => 'nullable|string|min:6|confirmed',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Update agent information
        $agent->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $agent->password,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully!');
    }

    public function destroy(Agent $agent)
    {
        // Delete the agent
        $agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully!');
    }


    public function storeReply(Request $request, Ticket $ticket)
    {
        // Retrieve the logged-in agent from the session
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in as an agent.');
        }
    
        $agentId = $user->id;
    
        // Validate the incoming request (response and optional file)
        $validated = $request->validate([
            'response' => 'required|string|max:10000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240', // Validate each file
            'status' => 'nullable|string|in:open,pending,resolved,closed'
        ]);
    
        // Handle file uploads if present
        $filePaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Store each file
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/uploads', $filename);
                $filePaths[] = str_replace('public/', '', $path); 
            }
        }
    
        // Save the reply in the TicketResponse model
        $ticketResponse = TicketResponse::create([
            'response' => $request->input('response'), // Correct response input
            'ticket_id' => $ticket->id,
            'agent_id' => $agentId,
            'customer_id' => null,
            'file_path' => count($filePaths) > 0 ? implode(',', $filePaths) : null,
        ]);
    
        // Update ticket status
        if ($request->has('status')) {
            $ticket->update([
                'status' => $request->input('status'),
                'last_response_at' => now(),
            ]);
        }
    
        // Return a response
        return redirect()->route('ticket-details-show', $ticket->id)
            ->with('success', 'Reply sent successfully');
    }
}
