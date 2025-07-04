<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tickets=Ticket::latest()->paginate(10);
        return view("admin.ticket.index", ["tickets" => $tickets]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $events = \App\Models\Event::all();
        $ticketTypes = \App\Models\TicketType::all();
        return view("admin.ticket.create_ticket", ["events" => $events, "ticketTypes" => $ticketTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated=$request->validate([
            "price" => "required|numeric",
            "qty" => "required|integer|min:1",
            "description" => "nullable|string|max:255",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "start_time" => "date_format:H:i",
            "end_time" => "date_format:H:i|after_or_equal:start_time",
            "event_id" => "required",
            "ticket_type_id" => "required"
        ]);
        // dd($validated);
        $validated["a_qty"]=$validated["qty"];
        Ticket::create($validated);
        return redirect("/admin/ticket")->with("success", "Ticket created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        return view("admin.ticket.show", ["ticket" => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //

        $events = \App\Models\Event::all();
        $ticketTypes = \App\Models\TicketType::all();
        return view("admin.ticket.edit", ["ticket" => $ticket, "events" => $events, "ticketTypes" => $ticketTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
        $validated = $request->validate([
            "price" => "required|numeric",
            "qty" => "required|integer|min:1",
            "description" => "nullable|string|max:255",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "start_time" => "date_format:H:i",
            "end_time" => "date_format:H:i|after_or_equal:start_time",
            "event_id" => "required",
            "ticket_type_id" => "required"
        ]);
        $validated["a_qty"] = $validated["qty"];
        $ticket->update($validated);
        return redirect("/admin/ticket")->with("success", "Ticket updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
        $ticket->delete();
        return redirect("/admin/ticket")->with("success", "Ticket deleted successfully.");
    }
}
