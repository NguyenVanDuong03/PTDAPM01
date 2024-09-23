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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('TenDangNhapKH');
            $table->string('TenKhachHang');
            $table->date('NgaySinh')->nullable();
            $table->String('GioiTinh')->default('Nam');
            $table->string('SDT', 13)->nullable();
            $table->string('Gmail')->nullable();
            
            $table->softDeletes();

            $table->foreign('TenDangNhapKH')->references('email')->on('users');


            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
