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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('TenDangNhapNV');
            $table->string('TenNhanVien');
            $table->date('NgaySinh');
            $table->String('GioiTinh')->default('Nam');
            $table->string('DiaChi');
            $table->date('NgayVaoLam');
            $table->string('ViTri');
            $table->string('SDT', 13);
            $table->string('Gmail');
            $table->date('NgayRa')->nullable();
            
            $table->softDeletes();
            $table->foreign('TenDangNhapNV')->references('email')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
