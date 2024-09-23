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
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id('MaTinTuc');
            $table->string('TenSuKien');
            $table->text('TomTat');
            $table->dateTime('NgayDang');
            $table->string('TenDangNhapNV');
            $table->text('NoiDung');
            $table->string('Anh');
            $table->foreign('TenDangNhapNV')->references('TenDangNhapNV')->on('nhan_viens');
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
