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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id');
            $table->string('title');
            $table->integer('category_id');
            $table->string('address');
            $table->string('city');
            $table->string('facility');
            $table->string('beds');
            $table->string('bathroom');
            $table->string('sqrft')->default(0);
            $table->string('rate')->default(0);
            $table->string('people_limit');
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('actual_price');
            $table->bigInteger('customer_price');
            $table->bigInteger('company_profit');
            $table->string('image');
            $table->longText('description');
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};