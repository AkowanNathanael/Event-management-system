<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable=[
            "title",
            "description",
            "image",
            "status",
            "start",
            "end",
            "venue_id",
            "category_id",
            "organiser_id"
    ];
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
      }
    public function organiser()
    {
        return $this->belongsTo(Organiser::class);
    }

}
