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
        Schema::create('leccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idgrupo');
            $table->foreign('idgrupo')->references('id')->on('grupo')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idmodulo');
            $table->foreign('idmodulo')->references('id')->on('modulo')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idprofesor')->nullable();
            $table->foreign('idprofesor')->references('id')->on('profesor')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('horas')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leccion');
    }
};
