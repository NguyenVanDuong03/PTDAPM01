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
        Schema::create('phims', function (Blueprint $table) {
            $table->id("MaPhim");
            $table->unsignedBigInteger('MaTheLoai');
            $table->foreign('MaTheLoai')->references('MaTheLoai')->on('the_loais');
            $table->unsignedBigInteger('MaNCC');
            $table->foreign('MaNCC')->references('MaNCC')->on('nha_cung_caps');
            $table->string("TenPhim");
            $table->float("ThoiLuong");
            $table->date("NgayCongChieu");
            $table->string("TrangThai");
            $table->text("MoTa");
            $table->string('DuongDan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phims');
    }
};
