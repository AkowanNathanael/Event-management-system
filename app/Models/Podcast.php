<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Podcast extends Model
{
    /** @use HasFactory<\Database\Factories\PodcastFactory> */
    use HasFactory;
    protected $fillable=[
            "title",
            "description",
            "audio",
            "category_id",
            "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
