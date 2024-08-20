<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('categorias', function (Blueprint $table) {
        $table->id(); // Por padrão, é unsignedBigInteger
        $table->string('nome');
        $table->string('codigo');
        $table->string('icone')->nullable();
        $table->text('descricao')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
