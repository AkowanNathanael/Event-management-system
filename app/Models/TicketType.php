<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    /** @use HasFactory<\Database\Factories\TicketTypeFactory> */
    use HasFactory;
    
    protected $fillable = [
        "name",
        "benefits",
        "description"
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);   
    }
}
