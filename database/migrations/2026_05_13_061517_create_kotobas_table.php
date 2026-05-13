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
        Schema::create('kotobas', function (Blueprint $table) {
            $table->id();
            $table->string('bab')->nullable();
            $table->string('japanese');
            $table->string('kanji')->nullable();
            $table->string('arti_indonesia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kotobas');
    }
};
