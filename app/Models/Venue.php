<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'address',
        'capacity',
        // 'facilities',
        'phone',
        'email',
    ];
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
