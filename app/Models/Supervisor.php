<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];

    // Relationship: A supervisor can have many agents
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
