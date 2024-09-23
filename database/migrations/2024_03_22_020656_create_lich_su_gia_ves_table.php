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
        Schema::create('lich_su_gia_ves', function (Blueprint $table) {
            $table->id("MaGiaVe");
            $table->unsignedBigInteger('MaLoaiGhe');
            $table->foreign('MaLoaiGhe')->references('MaLoaiGhe')->on('loai_ghes');
            $table->dateTime("ThoiGianTao");
            $table->decimal("GiaVe",10,3);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_gia_ves');
    }
};
