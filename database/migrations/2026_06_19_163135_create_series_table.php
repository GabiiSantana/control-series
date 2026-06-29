<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration responsável por criar a tabela series
return new class extends Migration {

    /**
     * Executado ao rodar: php artisan migrate
     */
    public function up(): void {

        // Cria a tabela series
        Schema::create('series', function (Blueprint $table) {

            // Chave primária auto incremento
            $table->id();

            // VARCHAR(128)
            $table->string('name', 128);

            // created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Executado ao rodar: php artisan migrate:rollback
     */
    public function down(): void {

        // Remove a tabela caso exista
        Schema::dropIfExists('series');
    }
};