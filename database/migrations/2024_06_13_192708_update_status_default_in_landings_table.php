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
        Schema::table('landings', function (Blueprint $table) {
            $table->enum('status', ['pending', 'lent', 'returned', 'overdue'])
                      ->default('pending')
                      ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->enum('status', ['lent', 'returned', 'overdue'])
                  ->default(null)
                  ->change();
        });
    }
};
