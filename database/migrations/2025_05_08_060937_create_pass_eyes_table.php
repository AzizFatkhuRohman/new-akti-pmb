<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pass_eyes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('R_SPH', 5, 2);
            $table->decimal('R_CYL', 5, 2);
            $table->decimal('R_AX', 5, 2);
            $table->decimal('L_SPH', 5, 2);
            $table->decimal('L_CYL', 5, 2);
            $table->decimal('L_AX', 5, 2);
            $table->enum('status', ['Lulus', 'Tidak']);
            $table->string('keterangan')->nullable();
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_eyes');
    }
};
