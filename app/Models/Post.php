<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "image",
        "category_id",
        "user_id",
    ];

    public function getImageAttribute($value)
    {
        return asset("storage/" . $value);
    }
    public function getRouteKeyName()
    {
        return "id";
    }

    public function getCategoryNameAttribute($value)
    {
        return $this->category->name;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
