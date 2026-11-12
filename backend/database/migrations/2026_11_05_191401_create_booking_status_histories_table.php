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
    Schema::create('booking_status_histories', function (Blueprint $table) {
        $table->id();

        $table->foreignId('fuel_booking_id')
            ->constrained('fuel_bookings')
            ->cascadeOnDelete();

        $table->foreignId('changed_by')
            ->constrained('users')
            ->restrictOnDelete();

        $table->string('old_status');
        $table->string('new_status');
        $table->timestamp('created_at')->useCurrent();

        $table->index(['fuel_booking_id', 'created_at']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_status_histories');
    }
};
