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
        Schema::create('truck_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('plat_no');
            $table->string('tipe_truck');
            $table->date('tgl_berangkat');
            $table->date('tgl_sampai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_schedules');
    }
};
