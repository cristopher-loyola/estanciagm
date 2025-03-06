<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Agrega esta línea
            $table->string('password')->nullable();
            $table->enum('role', ['admin', 'director', 'empleado', 'honorario']);
            $table->unsignedBigInteger('id_director')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();
            $table->integer('vacaciones')->default(0);
            $table->integer('permisos')->default(0);
            $table->integer('asistencia')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Relaciones
            $table->foreign('id_director')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_area')->references('id')->on('areas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
