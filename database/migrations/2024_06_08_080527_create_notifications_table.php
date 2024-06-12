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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('landing_id');
            $table->text('message');
            $table->timestamp('sent_at')->useCurrent();
            $table->enum('status', ['sent', 'pending']);

            // Add foreign key constraints if users and loans tables exist
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('landing_id')->references('id')->on('landings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
