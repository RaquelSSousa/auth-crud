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
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id()->primary()->comment('Identificador único da disciplina');
            $table->string('name')->comment('Nome da disciplina');
            $table->string('code')->unique()->comment('Código da disciplina');
            $table->integer('ch')->comment('Carga horária da disciplina');
            $table->boolean('active')->default(true)->comment('Status da disciplina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplines');
    }
};
