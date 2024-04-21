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
        Schema::create('master_truck', function (Blueprint $table) {
            $table->increments('no');
            $table->string('plat_no');
            $table->unsignedInteger('tipe_truck');
            $table->foreign('tipe_truck')->references('no')->on('master_tipe_truck');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_truck');
    }
};
