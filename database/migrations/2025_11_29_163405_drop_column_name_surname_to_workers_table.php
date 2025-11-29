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
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('surname');
            $table->dropColumn('email');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_worker_fk')->on('users')->references('id');
            $table->index('user_id', 'user_worker_idx');
            $table->fullText(['description', 'phone'], 'worker_full_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign('user_worker_fk');
            $table->dropIndex('user_worker_idx');
            $table->dropFullText('worker_full_text');
            $table->dropColumn('user_id');
            $table->string('email')->unique();
            $table->string('name', 60);
            $table->string('surname', 90)->nullable();
        });
    }
};
