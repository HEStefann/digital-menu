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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
            $table->string('address', 100)->default('')->change();
            $table->string('phone', 20)->default('')->change();
            $table->string('email', 50)->default('')->change();
            $table->string('instagram', 255)->default('')->change();
            $table->string('facebook', 255)->default('')->change();
            $table->string('website', 255)->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
