<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 1. Saare orders dashboard par dikhane ke liye
    public function dashboard()
    {
        $transactions = PaymentTransaction::with('product')->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('transactions'));
    }

    // 2. 1-Click Order Approve Logic (Secure Link Generator)
    public function approveOrder($id)
    {
        $transaction = PaymentTransaction::findOrFail($id);
        
        // Dynamic unique secure download token banana
        $secureToken = Str::random(40);

        $transaction->update([
            'payment_status' => 'completed',
            'secure_download_token' => $secureToken,
            'download_count_left' => 2 // Customer max 2 baar download kar sakta hai
        ]);

        return back()->with('success', 'Bhai, order approve ho gaya hai! Unique token generate ho chuka hai.');
    }

    // 3. Customer Secure Download Mechanism (Alag Se Function)
    public function downloadAsset($token)
    {
        // Token se transaction dhundo
        $transaction = PaymentTransaction::where('secure_download_token', $token)->firstOrFail();

        // Piracy Check: Agar download limit khatam ho gayi ho
        if ($transaction->download_count_left <= 0) {
            return response()->json(['error' => 'Bhai, aapki download limit khatam ho chuki hai! Support se contact karein.'], 403);
        }

        // Download count ek kam karo
        $transaction->decrement('download_count_left');

        // Response check block
        return response()->json([
            'success' => true,
            'message' => '🚀 Secure Node Connected! Downloading Asset: ' . $transaction->product->title,
            'download_path_vault' => $transaction->product->secure_zip_path,
            'downloads_remaining' => $transaction->download_count_left
        ]);
    }
}