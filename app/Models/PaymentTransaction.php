<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'order_reference_id', 'customer_email', 'product_id', 'amount_paid', 
        'gateway_used', 'payment_status', 'secure_download_token', 
        'download_count_left', 'upi_utr_number'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}