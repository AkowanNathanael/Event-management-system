<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /** @use HasFactory<\Database\Factories\ArtistFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'genre',
        'bio',
        'image',
        'website',
        'social_media',
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_artist');
    }
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Event::class);
    }

}
