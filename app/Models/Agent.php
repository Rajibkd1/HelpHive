<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'supervisor_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAuthIdentifierName()
    {
        return 'email'; // Use email as the identifier
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Relationship: An agent can have many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relationship: An agent can have many ticket responses
    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    // Relationship: An agent belongs to a supervisor
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
