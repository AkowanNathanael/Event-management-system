<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Receipt;
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
        $carts = Cart::where('user_id', Auth::id())->where("status","ordered")->get();
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
    public function destroy(Cart $cart , Ticket $ticket , Request $request)
    {
        //
        dd($cart, $request->query("a_qty"), $ticket);
        $ticket->a_qty += $request->query("a_qty", 0);
        $ticket->save();
        // $ticket_id=$cart->ticket_id;
        // $ticket=Ticket::find($ticket_id);
        // $ticket->a_qty +=$cart->quantity;
        // $ticket->save();
        // // dd($ticket, $ticket->a_qty, $cart->quantity);
        $cart->delete();
        return back()->with("message","ticket removed from cart");
    }
    function orders(){
        $carts = Cart::where('user_id', Auth::id())->where("status","paid")->get();
        return view('admin.order.index', [
            'carts' => $carts,
        ]);
    }

    function receipts(){
        $receipts=Receipt::where('user_id', Auth::id())->get();
        return view('admin.receipt.index', [
            'receipts' => $receipts,
        ]);
    }
    function verify(){
        return view("admin.receipt.verifiy");
    }

    function findReference(Request $request){
        $reference = $request->input('reference');
        if (!$reference) {
            return response()->json(['error' => 'Reference is required'], 400);
        }
        $receipt = Receipt::where('reference', $reference)->first();
        if (!$receipt) {
            return response()->json(['error' => 'Receipt not found'], 404);
        }
        return response()->json(['receipt' => $receipt, 'message' => 'Receipt found'], 200);

        // return view('admin.receipt.show', ['receipt' => $receipt]);

    }
}

