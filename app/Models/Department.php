<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the relationship with the tickets table (optional, if you want to use Eloquent relationships)
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}