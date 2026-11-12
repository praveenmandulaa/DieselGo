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
    Schema::create('fuel_bookings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('fuel_type_id')
            ->constrained()
            ->restrictOnDelete();

        $table->decimal('quantity_litres', 10, 2);
        $table->decimal('price_per_litre', 10, 2);
        $table->decimal('total_amount', 12, 2);

        $table->string('delivery_address');
        $table->string('phone', 20);

        $table->string('status')->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_bookings');
    }
};
