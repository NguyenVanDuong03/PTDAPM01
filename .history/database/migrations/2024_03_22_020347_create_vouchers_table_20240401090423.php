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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('MaVoucher');
            $table->string('TenDangNhapNV');
            $table->float('TiLeChietKhau');
            $table->float('HanMuc');
            $table->string('TinhTrang');
            $table->date('NgayTao');
            $table->dateTime('HanDung');
            $table->foreign('TenDangNhapNV')->references('TenDangNhapNV')->on('nhan_viens');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
