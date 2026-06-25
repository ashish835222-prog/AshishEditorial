<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PaymentTransaction;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Paytm Business UPI QR Code Automatic Generator Logic
    public function generateUpiQr(Product $product)
    {
        // Encoded standard credentials from WhatsApp Image 2026-06-23 at 3.08.21 AM.jpeg
        $merchantUpi = "paytmqr2810050501017v89jt6@paytm"; 
        $merchantName = urlencode("Ashish Kumar Rana");
        $transactionNote = urlencode("Ashish Editorial Asset - " . $product->title);
        $amount = $product->price_inr;

        // Dynamic deep-link generator string
        $upiString = "upi://pay?pa={$merchantUpi}&pn={$merchantName}&am={$amount}&tn={$transactionNote}&cu=INR";

        // External rendering API payload integration
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($upiString);

        return response()->json([
            'success' => true,
            'product_title' => $product->title,
            'price' => $amount,
            'qr_image_url' => $qrUrl,
            'paypal_id' => '@329652' // Stored user id backup framework
        ]);
    }

    // Capture User Banking Transaction UTR for Verification
    public function storeUpiReceipt(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'product_id' => 'required|exists:products,id',
            'utr_number' => 'required|digits:12'
        ]);

        $product = Product::find($request->product_id);

        PaymentTransaction::create([
            'order_reference_id' => 'AE-' . strtoupper(Str::random(8)),
            'customer_email' => $request->email,
            'product_id' => $product->id,
            'amount_paid' => $product->price_inr,
            'gateway_used' => 'paytm_upi_qr',
            'upi_utr_number' => $request->utr_number,
            'payment_status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bhai, UTR Number mil gaya hai! Panel check karke files active kar dega.'
        ]);
    }
}