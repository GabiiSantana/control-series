<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration responsável por criar a tabela episodes
return new class extends Migration {

    // Executado ao rodar: php artisan migrate
    public function up(): void {

        Schema::create('episodes', function (Blueprint $table) {

            // Chave primária
            $table->id();

            // Número do episódio (1, 2, 3...)
            $table->unsignedTinyInteger('number');

            // Chave estrangeira para a tabela seasons
            // Ao excluir uma temporada, seus episódios também serão removidos
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');

            // created_at e updated_at
            $table->timestamps();
        });
    }

    // Executado ao rodar: php artisan migrate:rollback
    public function down(): void {

        Schema::dropIfExists('episodes');
    }
};