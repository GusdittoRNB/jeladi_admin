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
        Schema::table('users', function(Blueprint $table) {
            $table->string('nik', length: 20)->nullable();
            $table->string('gender', length: 10)->default('L');
            $table->string('address', length: 250)->nullable();
            $table->string('phone', length: 20)->nullable();
            $table->string('role')->default('user');
            $table->string('profile_picture')->nullable();
            $table->string('status')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function($table) {
            $table->dropColumn('nik');
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('role');
            $table->dropColumn('profile_picture');
            $table->dropColumn('status');
        });
    }
};
