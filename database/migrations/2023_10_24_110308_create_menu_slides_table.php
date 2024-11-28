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
        Schema::create('menu_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title',250)->nullable();
            $table->string('url',250)->nullable();
            $table->integer('index')->default(0)->nullable();
            $table->string('blob',150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_slides');
    }
};