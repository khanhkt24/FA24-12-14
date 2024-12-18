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
        Schema::create('pro_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('id_order');
            $table->integer('id_pro');
            $table->string('name_pro');
            $table->string('img');
            $table->string('price');
            $table->string('color');
            $table->string('size');
            $table->integer('quantity');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pro_orders');
    }
};
