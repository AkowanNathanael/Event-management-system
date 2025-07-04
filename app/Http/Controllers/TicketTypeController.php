<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketTypeRequest;
use App\Http\Requests\UpdateTicketTypeRequest;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tickettypes = TicketType::latest()->get();
        return view("admin.ticketType.index", ["tickettypes" => $tickettypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.ticketType.create_ticketType");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "name" => ["required"],
            "benefits" => ["nullable"],
            "description" => ["nullable"]
        ]);
        TicketType::create($validated);
        return redirect("/admin/tickettype")->with("success", "ticket type created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketType $ticketType)
    {
        //
        return view("admin.ticketType.edit", ["ticketType" => $ticketType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketType $ticketType)
    {
        //
        // dd($ticketType);
        return view("admin.ticketType.edit", ["ticketType" => $ticketType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketType $ticketType)
    {
        //
        $validated = $request->validate([
            "name" => ["required"],
            "benefits" => ["nullable"],
            "description" => ["nullable"]
        ]);
        $ticketType->update($validated);
        return redirect("/admin/tickettype")->with("success", "ticket type updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketType $ticketType)
    {
        //
        $ticketType->delete();
        return redirect("/admin/tickettype")->with("success", "ticket type deleted");
    }
}
