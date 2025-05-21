<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Verwijst naar de gebruiker
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Verwijst naar de gekozen koffie
            $table->foreignId('coffee_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('quantity')->default(1);

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
}
