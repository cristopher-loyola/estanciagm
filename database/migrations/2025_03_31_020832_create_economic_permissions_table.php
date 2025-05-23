<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down()
    {
        Schema::dropIfExists('economic_permissions');
    }
    public function up()
    {
        Schema::create('economic_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->text('reason');
            $table->string('status')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->timestamps();
        });
    }

};