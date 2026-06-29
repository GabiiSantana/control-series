<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model que representa a tabela episodes
class Episode extends Model {

    // Adiciona suporte às Factories (geração de dados fictícios para testes)
    use HasFactory;

    // Campos que podem ser preenchidos em massa (Mass Assignment)
    protected $fillable = ['number'];

    // A tabela não possui as colunas created_at e updated_at
    public $timestamps = false;

    // Um episódio pertence a uma temporada
    public function season() {
        return $this->belongsTo(Season::class);
    }

}