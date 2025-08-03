<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $fillable=[
        "user_id",
        "cart_id",
        "quantity",
        "file",
        "owner",
        "status",
        "reference"

    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }
}
