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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->float('sub_total');
            $table->float('shipping');
            $table->float('total_amount');
            $table->string('full_name');
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('zip_code');
            $table->string('phone');
            $table->enum('status',['pending','processing','approved','delivered','on the way'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
