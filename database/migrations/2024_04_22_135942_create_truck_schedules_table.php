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
            // $table->id();
            // $table->string('plat_no');
            // $table->string('tipe_truck');
            // $table->date('tgl_berangkat');
            // $table->date('tgl_sampai');
            // $table->timestamps();

            // $table->id();
            // $table->string('nama_driver',255);
            // $table->string('plat_no');
            // $table->unsignedInteger('tipe_truck');
            // $table->foreign('tipe_truck')->references('no')->on('master_tipe_truck');
            // $table->date('tgl_berangkat');
            // $table->date('tgl_sampai');
            // $table->timestamps();

            $table->id();
            $table->bigInteger('nama_driver')->unsigned();
            $table->foreign('nama_driver')->references('id')->on('drivers');
            $table->string('plat_no');
            $table->unsignedInteger('tipe_truck');
            $table->foreign('tipe_truck')->references('no')->on('master_tipe_truck');
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
