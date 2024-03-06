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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->integer('user_id');
            $table->integer('transaction_id');
            $table->integer('ride_id');
            $table->string('check_in');
            $table->string('check_out');
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('tax')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->integer('guest_adult')->nullable();
            $table->integer('guest_children')->nullable();
            $table->integer('guest_infant')->nullable();
            $table->longText('cancle_reason')->nullable();
            $table->enum('booked_ride', [0,1]);
            $table->enum('ride_rental_type', ['airport_park_pickup',' picked_rental_dates','full_stay_rental']);
            $table->enum('payment_type', ['pay_with_merchants','pay_with_crypto','pay_with_bank_transfer']);
            $table->enum('status', ['Booked','Check_in','Completed','Cancelled','Confirmed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
