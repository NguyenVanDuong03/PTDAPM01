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
        Schema::create('phong_chieus', function (Blueprint $table) {
            $table->id('MaPhong');
            $table->string('TenPhong');
            $table->unsignedBigInteger('MaLoaiPhong');
            $table->integer('SoLuongGhe');
            $table->string('TinhTrang');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('MaLoaiPhong')->references('MaLoaiPhong')->on('loai_phongs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phong_chieus');
    }
};
