<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'customer_id',
        'agent_id'
    ];

    // Relationship: A ticket belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship: A ticket can belong to one agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    // Relationship: A ticket can have many responses
    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    // Relationship: A ticket can have many uploads (file attachments)
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}
