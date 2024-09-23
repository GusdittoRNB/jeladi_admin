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
        Schema::table('demografi_kelompok', function(Blueprint $table) {
            $table->integer('order_number')->nullable();
        });

        $dmKel = \App\Models\DemografiKelompok::get();
        if ($dmKel->count() > 0) {
            foreach ($dmKel->groupBy('demografi_jenis_id') as $dmkj) {
                $no = 1;
                foreach ($dmkj as $dmk) {
                    $dmk->update(['order_number' => $no]);
                    $no++;
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demografi_kelompok', function($table) {
            $table->dropColumn('order_number');
        });
    }
};
