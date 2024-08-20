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
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('foto')->nullable();
        $table->decimal('valor', 8, 2);
        $table->unsignedBigInteger('categoria_id'); // Certifique-se de que é unsignedBigInteger
        $table->integer('quantidade');
        $table->timestamps();

        $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
