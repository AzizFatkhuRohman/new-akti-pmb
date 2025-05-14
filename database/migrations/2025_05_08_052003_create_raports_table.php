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
        Schema::create('raports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->integer('nilai_mtk_1');
            $table->integer('nilai_indo_1');
            $table->integer('nilai_inggris_1');
            $table->integer('nilai_mtk_2');
            $table->integer('nilai_indo_2');
            $table->integer('nilai_inggris_2');
            $table->integer('nilai_mtk_3');
            $table->integer('nilai_indo_3');
            $table->integer('nilai_inggris_3');
            $table->integer('nilai_mtk_4');
            $table->integer('nilai_indo_4');
            $table->integer('nilai_inggris_4');
            $table->integer('nilai_mtk_5')->nullable();
            $table->integer('nilai_indo_5')->nullable();
            $table->integer('nilai_inggris_5')->nullable();
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raports');
    }
};
