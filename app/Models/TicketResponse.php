<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'response',
        'ticket_id',
        'agent_id',
        'file_path',
        'customer_id',  // Add customer_id to the fillable array
    ];

    // Relationship: A ticket response belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relationship: A ticket response belongs to an agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    // Relationship: A ticket response belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
