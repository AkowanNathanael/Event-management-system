<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $fillable = [
        'price',
        'qty',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'event_id', 
        'ticket_type_id'
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
  
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
