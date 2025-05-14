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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->char('nik',16);
            $table->enum('status_wali',['Hidup','Wafat']);
            $table->string('nama',50);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('pendidikan',['Tidak ada','SD','SMP','SMA','S1','S2','S3']);
            $table->string('pekerjaan');
            $table->integer('penghasilan');
            $table->enum('status_pernikahan',['Menikah','Duda']);
            $table->char('province_id', 2);
            $table->char('city_id', 4);
            $table->char('district_id', 7);
            $table->char('village_id', 10);
            $table->string('alamat');
            $table->string('file_wali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
