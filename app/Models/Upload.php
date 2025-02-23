<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'ticket_id'
    ];

    // Relationship: An upload belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
