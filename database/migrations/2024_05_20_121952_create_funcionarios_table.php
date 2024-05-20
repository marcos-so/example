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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->date('data_nascimento');
            $table->string('cargo', 100);
            $table->unsignedBigInteger('departamento_id');
            $table->string('email', 100);
            $table->string('telefone', 15);
            $table->date('data_contratacao');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
