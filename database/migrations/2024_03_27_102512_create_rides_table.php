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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('ride_tpe');
            $table->string('model');
            $table->string('color');
            $table->string('image');
            $table->bigInteger('actual_price_per_day');
            $table->bigInteger('customer_price_per_day');
            $table->bigInteger('company_profit_per_day');
            $table->bigInteger('airport_park_pickup_actual_price');
            $table->bigInteger('airport_park_pickup_customer_price');
            $table->bigInteger('airport_park_pickup_company_profit');
            $table->date('unavaliable_from')->nullable();
            $table->date('unavaliable_to')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
