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
        Schema::create('profesor', function (Blueprint $table) {
            $table->id();
            $table->string('seneca_username', 20)->unique();
            $table->string('nombre', 100);
            $table->string('apellido1', 100);
            $table->string('apellido2', 100)->nullable();
            $table->string('email', 120)->unique();
            $table->string('especialidad', 100);
            $table->timestamps();
        });

        // Damos de alta un 'profesor' auxiliar que usaremos para establacer las lecciones a null
        $sql = "insert into users (seneca_username, nombre, apellido1, apellido2, email, especialidad, created_at, updated_at) VALUES ('lm2024', 'LessonManagement', 'SA', '2024', 'aux@lessonamnagement.com', 'auxiliar', '2024-02-21 10:07:58', '2024-02-21 10:07:58');";
        DB::statement($sql);
        
        $sql = "insert into profesor (seneca_username, nombre, apellido1, apellido2, email, especialidad, created_at, updated_at) VALUES ('mjimpal1234', 'Mode', 'Martínez', 'Palenzuela', 'mode@ieszaidinvergeles.org', 'diseño', '2024-02-21 10:07:58', '2024-02-21 10:07:58');";
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};
