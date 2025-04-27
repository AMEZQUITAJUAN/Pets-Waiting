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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD

            $table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
=======
>>>>>>> 8deacc72ba314f336d96239c60cdfd7e9a0955df
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->enum('categoria', ['perdidos', 'adopcion', 'rescatados', 'fundaciones']);
            $table->string('imagen')->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('publicaciones');
    }
};
