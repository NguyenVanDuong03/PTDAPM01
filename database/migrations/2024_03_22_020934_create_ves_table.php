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
        Schema::create('ves', function (Blueprint $table) {
            $table->id('MaVe');
            $table->unsignedBigInteger('MaHoaDon');
            $table->unsignedBigInteger('MaLichChieu');
            $table->unsignedBigInteger('MaGhe');
            $table->boolean('TrangThai')->default(1);
            $table->timestamps();

            $table->foreign('MaHoaDon')->references('MaHoaDon')->on('hoa_dons');
            $table->foreign('MaLichChieu')->references('MaLichChieu')->on('lich_chieus');
            $table->foreign('MaGhe')->references('MaGhe')->on('ghe_ngois');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves');
    }
};
