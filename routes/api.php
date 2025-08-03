<?php

use App\Models\Event;
use App\Models\Receipt;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/events", function () {
    return Event::all();
});

Route::post("/receipt", function (Request $request) {
    // id, user,cart,file,date,receipt owner,reference,quantity
    Log::debug('Receipt generation started');  // Add this line

    try {
        Log::info('Validating request data');  // Add this
        $validated = $request->validate([
            "email-address" => ["email"],
            "amount" => ["decimal:2", "required"],
            "first-name" => ["string", "required"],
            "middle-name" => ["string", "required"],
            "last-name" => ["string", "required"],
            "reference" => ["string", "required"]
        ]);

        // Generate invoice ID
        $invoice_id = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);

        Log::info('Loading user data');  // Add this
        $user = User::with([
            "carts" => function ($query) {
                $query->where("status", "ordered")->with(["ticket.event"]);
            }
        ])->findOrFail($request->query("user"));

        Log::info('User and carts loaded', [  // Add this
            'user_id' => $user->id,
            'cart_count' => $user->carts->count()
        ]);

        // Update status value in the collection to 'paid'
        $user->carts->each(function ($cart) {
            $cart->status = 'paid';
            $cart->save();
            Log::info('Cart status updated', [
            'cart_id' => $cart->id,
            'status' => $cart->status
            ]);
        });
        $carts = $user->carts;
        // $carts is a Laravel Collection, which behaves like an array in many ways.
        // You can use array-like methods such as foreach, count, etc.
        // dd($carts);
        $filename="receipt".time().".pdf";
        $file_path="receipt/". $filename;
        $customer = $user;
        try {
            // Log view data
            Log::info('View data:', [
                'validated' => $validated,
                'carts' => $carts,
                'customer' => $customer
            ]);

            // Clear any previous output buffers
            while (ob_get_level()) ob_end_clean();

            Log::info('Starting PDF generation...', [
                'user_id' => $request->query('user'),
                'file_path' => $file_path
            ]);

            // Create PDF
            $pdf = PDF::loadView('receipt.index', [
                "validated" => $validated,
                "carts" => $carts,
                "customer" =>$user,
                "invoice_id" => $invoice_id  // Add this line
            ]);
            foreach ($carts as $cart) {
                Log::info('Cart debug', [
                    'cart_id' => $cart->id,
                    'ticket' => $cart->ticket,
                    'event' => $cart->ticket ? $cart->ticket->event : null
                ]);
            }

            // Force PDF to render
            $pdfContent = $pdf->output();
            Log::info('PDF Generated', ['size' => strlen($pdfContent)]);

            // Create directory if it doesn't exist
            if (!Storage::disk('public')->exists('receipt')) {
                Storage::disk('public')->makeDirectory('receipt');
                Log::info('Created receipt directory');
            }

            // Save PDF
            $success = Storage::disk('public')->put($file_path, $pdfContent);
            Log::info('PDF Save Attempt', [
                'success' => $success,
                'path' => $file_path,
                'exists' => Storage::disk('public')->exists($file_path)
            ]);

            if (!$success) {
                throw new \Exception('Failed to save PDF file');
            }
            //
            Receipt::create(["user_id" => $user->id, "quantity" => $carts->sum('quantity'), "file" => $file_path,  "owner" => $validated["first-name"] . " " . $validated["middle-name"] . " " . $validated["last-name"], "reference" => $validated["reference"],"status"=>"paid"]);
            Log::info('Receipt created', [
                'user_id' => $user->id,
                'owner' => $validated["first-name"] . " " . $validated["middle-name"] . " " . $validated["last-name"],
                'reference' => $validated["reference"]
            ]);
            return response()->json([
                "message" => "Receipt generated successfully",
                "file_path" => Storage::url($file_path)
            ]);

        } catch (\Exception $e) {
            Log::error('PDF Generation Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                "error" => "Failed to generate receipt: " . $e->getMessage()
            ], 500);
        }
    } catch (\Exception $e) {
        Log::error('Error in receipt generation: ' . $e->getMessage());
        throw $e;
    }
    //

});

