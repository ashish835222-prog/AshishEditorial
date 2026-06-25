<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Homepage Route
Route::get('/', function () {
    return view('welcome');
});

// Dynamic QR Generator Route (Pass product id to get Paytm QR)
Route::get('/pay/upi/{product}', [PaymentController::class, 'generateUpiQr'])->name('pay.upi');

// Store Submitted Transaction UTR Reference Route
Route::post('/pay/upi/verify', [PaymentController::class, 'storeUpiReceipt'])->name('pay.verify');
use App\Http\Controllers\AdminController;

// Admin Panel Console URL
Route::get('/ashish-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Order Approval Post Route
Route::post('/ashish-admin/approve/{id}', [AdminController::class, 'approveOrder'])->name('admin.approve');
// Secure Asset Download Route
Route::get('/download/{token}', [AdminController::class, 'downloadAsset'])->name('asset.download');