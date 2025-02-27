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
        Schema::create('lich_su_gia_do_ans', function (Blueprint $table) {
            $table->id('MaGiaDoAn');
            $table->unsignedBigInteger('MaDoAn');
            $table->dateTime('ThoiGianTao');
            $table->double('Gia');

            $table->foreign('MaDoAn')->references('MaDoAn')->on('do_ans');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_gia_do_ans');
    }
};
