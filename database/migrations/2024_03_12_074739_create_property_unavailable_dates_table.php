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
        Schema::create('property_unavailable_dates', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->datetime('from');
            $table->datetime('to');
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_unavailable_dates');
    }
};
