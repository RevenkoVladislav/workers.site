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
        Schema::create('workers', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', 60);
            $table->string('surname', 90)->nullable();
            $table->string('email')->unique();
            $table->integer('age')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_married')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
