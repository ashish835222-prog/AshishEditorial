<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_reference_id')->unique();
            $table->string('customer_email');
            $table->foreignId('product_id')->constrained('products');
            $table->decimal('amount_paid', 10, 2);
            $table->enum('gateway_used', ['paytm_upi_qr', 'paypal']);
            $table->string('payment_status')->default('pending'); // pending, completed, failed
            $table->string('secure_download_token')->unique()->nullable();
            $table->integer('download_count_left')->default(2); // Anti-piracy check
            $table->string('upi_utr_number', 12)->nullable(); // Paytm Ref No/UTR string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};