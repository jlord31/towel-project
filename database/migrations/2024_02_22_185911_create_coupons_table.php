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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('coupon_code');
            $table->bigInteger('value');
            $table->bigInteger('total_discount_given')->default(0);
            $table->bigInteger('total_current_use')->default(0);
            $table->bigInteger('total_use_allowed');
            $table->timestamp('expiration_date');
            $table->text('img')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
