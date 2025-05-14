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
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); // Usuario que recibe la notificación
            $table->string('tipo'); // Tipo de notificación (encontrado, etc.)
            $table->text('mensaje');
            $table->string('url')->nullable(); // URL para redirigir al hacer clic
            $table->boolean('leido')->default(false);
            $table->unsignedBigInteger('referencia_id')->nullable(); // ID de la entidad relacionada
            $table->string('referencia_tipo')->nullable(); // Tipo de la entidad relacionada (modelo)
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacions');
    }
};
