<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('type', ['root', 'admin', 'user'])->default('user');
            $table->timestamps();
        });

        // Creamos usuario root por defecto al aplicar las migraciones
        $pass = Hash::make('lm2024');
        $sql = "insert into users (name, email, email_verified_at, password, type, created_at, updated_at) VALUES ('Root', 'root@root.es', '2024-02-21 10:07:58', '". $pass ."', 'root', '2024-02-21 10:07:58', '2024-02-21 10:07:58')";
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
