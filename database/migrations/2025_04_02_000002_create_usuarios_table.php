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
    $table->string('nombre', 100);
    $table->string('email', 100)->unique();
    $table->string('password', 255);
    $table->enum('tipo', ['usuario', 'administrador', 'super_administrador']);
    $table->timestamps(); // ¡Esto ya agrega created_at y updated_at!
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
