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
        Schema::create('workings', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id', 'working_company_id_fk')->references('id')->on('companies');
            $table->unsignedBigInteger('manager_id');
            $table->foreign('manager_id', 'working_manager_id_fk')->references('id')->on('managers');
            $table->date('work_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workings');
    }
};
