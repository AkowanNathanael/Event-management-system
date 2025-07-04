<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;
    protected $fillable=[
        "question_text",
        "quiz_id"
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    public function options(){
        return $this->hasMany(Option::class);
    }
}
