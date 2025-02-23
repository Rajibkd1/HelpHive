<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable 
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'address', 'gender', 'dob', 'mobile_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship: A customer can have many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
