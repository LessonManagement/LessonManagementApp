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
        Schema::create('modulo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idformacion');
            $table->foreign('idformacion')->references('id')->on('formacion')->onUpdate('cascade')->onDelete('cascade');
            $table->string('denominacion', 100);
            $table->string('siglas', 10);
            $table->integer('curso');
            $table->integer('horas');
            $table->string('especialidad', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo');
    }
};
