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
        Schema::create('events_participants', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')
                ->constrained('events')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->integer('participant_id')
                ->constrained('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_participants');
    }
};
