<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'profile_picture',
        'gender',
        'dob',
        'mobile_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Method to check the user credentials
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

    // Relationship: A customer can have many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
