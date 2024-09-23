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
        Schema::create('ghe_ngois', function (Blueprint $table) {
            $table->id("MaGhe");
            $table->string("ViTriDay");
            $table->string("ViTriCot");
            $table->unsignedBigInteger('MaPhong');
            $table->foreign('MaPhong')->references('MaPhong')->on('phong_chieus');
            $table->unsignedBigInteger('MaLoaiGhe');
            $table->foreign('MaLoaiGhe')->references('MaLoaiGhe')->on('loai_ghes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ghe_ngois');
    }
};
