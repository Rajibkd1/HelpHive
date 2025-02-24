<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Supervisor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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

    // Relationship: A supervisor can have many agents
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
