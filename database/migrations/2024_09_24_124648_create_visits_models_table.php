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
        Schema::create('visits_models', function (Blueprint $table) {
            $table->id();
            $table->string('resident_id');
            $table->string('visitor_id');
            $table->string('roomNumber');
            $table->string('timeOfVisit');
            $table->string('timeOfLeaving');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits_models');
    }
};
