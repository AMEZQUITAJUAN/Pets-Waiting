<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perdidos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('especie', ['perro', 'gato', 'otro']);
            $table->string('raza')->nullable();
            $table->text('descripcion');
            $table->string('ubicacion');
            $table->date('fecha_perdida');
            $table->string('contacto');
            $table->string('imagen')->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('estado', ['perdido', 'encontrado'])->default('perdido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perdidos');
    }
};
