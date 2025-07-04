<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carts = Cart::where('user_id', Auth::id())->get();
        // dd($carts);
        return view('admin.cart.index', [
            'carts' => $carts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ticket $ticket)
    {
        //
        // dd(Auth::user()->id,$request,$ticket);
        if ($ticket->a_qty < $request->input('quantity', 1)) {
            return redirect()->back()->withErrors(['quantity' => 'Not enough tickets available.']);
        }
        $ticket->a_qty -= $request->input('quantity', 1);
        $ticket->save();
        Cart::create([
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticket->id,
            'quantity' => $request->input('quantity', 1), // Default to 1 if not provided
            'status' => 'active', // Default status
            'price' => $ticket->price ,
            'total_price' => $ticket->price * ($request->input('quantity', 1)), // Calculate total price
        ]);
        return redirect('/admin/cart')->with('success', 'Ticket added to cart successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
