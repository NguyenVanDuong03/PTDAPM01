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
        Schema::create('lich_chieus', function (Blueprint $table) {
            $table->id('MaLichChieu');
            $table->unsignedBigInteger('MaPhim');
            // $table->dateTime('ThoiGianBatDau');
            $table->date('NgayChieu');
            $table->time('GioChieu');
            $table->unsignedBigInteger('MaPhong');

            $table->foreign('MaPhim')->references('MaPhim')->on('phims');
            $table->foreign('MaPhong')->references('MaPhong')->on('phong_chieus');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_chieus');
    }
};
