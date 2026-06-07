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
        Schema::table('bunpos', function (Blueprint $table) {
            $table->string('level')->default('N4')->after('id');
        });

        Schema::table('kotobas', function (Blueprint $table) {
            $table->string('level')->default('N4')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bunpos', function (Blueprint $table) {
            $table->dropColumn('level');
        });

        Schema::table('kotobas', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
