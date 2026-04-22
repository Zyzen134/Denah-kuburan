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
        Schema::table('deceaseds', function (Blueprint $table) {
            $table->integer('age_at_death')->nullable()->after('death_date');
            $table->string('gender')->nullable()->after('age_at_death');
            $table->string('photo')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deceaseds', function (Blueprint $table) {
            $table->dropColumn(['age_at_death', 'gender', 'photo']);
        });
    }
};
