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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 255);
            $table->enum('type', ['Publica', 'Privada'])->default('Publica');
            $table->integer('event_organizer')
                ->constrained('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('organizing_company', 255);
            $table->boolean('active')->default(true);
            $table->integer('max_participants')->default(0);
            $table->string('duration_time');
            $table->timestamp('event_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
