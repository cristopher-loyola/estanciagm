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
         Schema::create('permisos_economicos', function (Blueprint $table) {
             $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->dateTime('fecha_solicitud');
             $table->date('fecha_inicio');
             $table->date('fecha_fin');
             $table->text('motivo');
             $table->string('estado')->default('pendiente');
             $table->timestamps();
         });
     }
 
     public function down(): void
     {
         Schema::dropIfExists('permisos_economicos');
     }
};
