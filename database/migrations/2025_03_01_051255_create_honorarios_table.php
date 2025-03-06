<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('honorarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('id_director')->constrained('directors')->onDelete('cascade'); // Relación con directores
            $table->string('contraseña');
            $table->integer('asistencia')->default(0);
            $table->integer('vacaciones')->default(0);
            $table->integer('permisos')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('honorarios');
    }
};
