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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); // en minúsculas
            $table->string('email', 100)->unique();
            $table->string('password', 255); // no 'contraseña'
            $table->string('telefono', 20)->nullable(); // por si lo usas en el form
            $table->enum('tipo', ['usuario', 'administrador', 'super_administrador'])->default('usuario');
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
