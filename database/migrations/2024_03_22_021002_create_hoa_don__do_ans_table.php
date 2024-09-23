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
        Schema::create('hoa_don__do_ans', function (Blueprint $table) {
            $table->unsignedBigInteger('MaDoAn');
            $table->unsignedBigInteger('MaHoaDon');
            $table->integer('SoLuongMua');
            $table->timestamps();

            $table->foreign('MaDoAn')->references('MaDoAn')->on('do_ans');
            $table->foreign('MaHoaDon')->references('MaHoaDon')->on('hoa_dons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don__do_ans');
    }
};
