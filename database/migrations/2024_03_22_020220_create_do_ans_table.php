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
            $table->string('Anh');
            $table->string('TenDoAn');
            $table->unsignedBigInteger('MaTheLoai');
            $table->text('MoTa');
            $table->string('TinhTrang');
            $table->foreign('MaTheLoai')->references('MaTheLoai')->on('loai_do_ans')->onDelete('cascade');
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
