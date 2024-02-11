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
        Schema::create('grupo', function (Blueprint $table) {
            $table->id();
            $table->integer('curso_escolar');
            $table->foreignId('idformacion');
            $table->foreign('idformacion')->references('id')->on('formacion')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('curso');
            $table->string('denominacion', 150);
            $table->string('turno', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo');
    }
};
