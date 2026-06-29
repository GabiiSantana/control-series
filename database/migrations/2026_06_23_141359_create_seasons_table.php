<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration responsável por criar a tabela seasons
return new class extends Migration {

    // Executado ao rodar: php artisan migrate
    public function up(): void {

        Schema::create('seasons', function (Blueprint $table) {

            // Chave primária
            $table->id();

            // Número da temporada (1, 2, 3...)
            $table->unsignedTinyInteger('number');

            // Chave estrangeira para a tabela series
            // Ao excluir uma série, suas temporadas também serão removidas
            $table->foreignId('series_id')
                ->constrained()
                ->onDelete('cascade');

            // created_at e updated_at
            $table->timestamps();
        });
    }

    // Executado ao rodar: php artisan migrate:rollback
    public function down(): void {

        Schema::dropIfExists('seasons');
    }
};