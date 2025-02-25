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
        'file_path'
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
}
