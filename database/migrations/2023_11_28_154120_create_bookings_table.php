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
            $table->foreignId("client_id")->constrained("clients", "id");
            $table->foreignId("hotel_id")->constrained("hotels", "id");
            $table->date("arrival_date");
            $table->date("departure_date");
            $table->integer("nights_number",);
            $table->decimal("amount", 8, 2);
            $table->json("guests");
            $table->enum('status', ['provisional', 'confirmada', 'cancelada'])->default("provisional");
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
