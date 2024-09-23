<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id('MaHoaDon');
            $table->string('TenDangNhapKH');
            $table->string('TenDangNhapNV')->nullable();
            $table->unsignedBigInteger('MaVoucher')->nullable();
            $table->dateTime('ThoiGianTao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('ThoiGianXuat')->nullable();
            $table->timestamps();

            $table->foreign('TenDangNhapKH')->references('TenDangNhapKH')->on('khach_hangs');
            $table->foreign('TenDangNhapNV')->references('TenDangNhapNV')->on('nhan_viens');
            $table->foreign('MaVoucher')->references('MaVoucher')->on('vouchers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
