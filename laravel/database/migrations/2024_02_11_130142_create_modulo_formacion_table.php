<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modulo_formacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idmodulo');
            $table->foreign('idmodulo')->references('id')->on('modulo')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idformacion');
            $table->foreign('idformacion')->references('id')->on('formacion')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            // Restriccion para que un modulo no este asociado mas de una vez con la misma formacion
            $table->unique(['idmodulo', 'idformacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_formacion');
    }
};
