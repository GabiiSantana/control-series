<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model que representa a tabela series
class Series extends Model {

    // Permite criar dados fictícios com Factories
    use HasFactory;

    // Campos liberados para preenchimento em massa
    protected $fillable = ['name'];

    // Carrega as temporadas automaticamente ao buscar uma série
    protected $with = ['seasons'];

    // Uma série possui várias temporadas
    public function seasons() {
        return $this->hasMany(Season::class, 'series_id');
    }

    // Executado quando o model é inicializado
    protected static function booted() {

        // Escopo global: ordena todas as consultas por nome
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}