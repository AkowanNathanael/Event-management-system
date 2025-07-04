<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organiser extends Model
{
    /** @use HasFactory<\Database\Factories\OrganiserFactory> */
    use HasFactory;
    protected $fillable=[
        "name",
        "phone",
        "image"
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Event::class);
    }
}
