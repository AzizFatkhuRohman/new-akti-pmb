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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('entry_route_id')->constrained();
            $table->string('name',50);
            $table->char('nik',16)->unique();
            $table->integer('no_telp');
            $table->string('email',50);
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('negara');
            $table->enum('agama',['Islam','Katolik','Kristen','Konghucu','Hindu','Budha']);
            $table->enum('status_pernikahan',['Belum menikah','Sudah menikah']);
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->enum('golongan_darah',['A+','A-','B+','B-','AB+','AB-','O+','O-']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->char('province_id', 2);
            $table->char('city_id', 4);
            $table->char('district_id', 7);
            $table->char('village_id', 10);
            $table->string('alamat');
            $table->string('file_student'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
