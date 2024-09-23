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
        Schema::create('do_ans', function (Blueprint $table) {
            $table->id('MaDoAn');
            $table->unsignedBigInteger('MaTheLoai');
            $table->string('TenDoAn');
            $table->string('TinhTrang');
            $table->string('Anh');

            $table->foreign('MaTheLoai')->references('MaTheLoai')->on('loai_do_ans');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do_ans');
    }
};
