<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable=[
       "name","description"
    ];
   public function posts(){
    return $this->hasMany(Post::class);
   }
   public function podcasts(){
    return $this->hasMany(Podcast::class);
   }

    public function events(){
     return $this->hasMany(Event::class);
    }
    public function tickets(){
      return $this->hasManyThrough(Ticket::class, Event::class);
    }
    public function artists(){
      return $this->hasMany(Artist::class);
    }
    public function venues(){
      return $this->hasMany(Venue::class);
    }
    public function organisers(){
      return $this->hasMany(Organiser::class);
    }
    public function ticketTypes(){
      return $this->hasMany(TicketType::class);
    }
}
