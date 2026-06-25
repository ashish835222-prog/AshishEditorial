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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['premiere_project', 'lut', 'invitation_template', 'preset', 'overlay']);
            $table->decimal('price_inr', 10, 2);
            $table->string('secure_zip_path'); // Safe file storage path
            $table->string('demo_video_url')->nullable(); // For video previews
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};