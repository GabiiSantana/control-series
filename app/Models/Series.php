<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model que representa a tabela series
class Series extends Model {
    protected $appends = ['links'];

    // Permite criar dados fictícios com Factories
    use HasFactory;

    // Campos liberados para preenchimento em massa
    protected $fillable = ['name','cover'];

    // Carrega as temporadas automaticamente ao buscar uma série
    protected $with = ['seasons'];

    // Uma série possui várias temporadas
    public function seasons() {
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes() {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    // Executado quando o model é inicializado
    protected static function booted() {

        // Escopo global: ordena todas as consultas por nome
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }

    public function links():Attribute {
        return new Attribute(
            get: fn () => [
                [
                    'rel'=>'self',
                    'url'=>"/api/series/{$this->id}"
                ],
                [
                    'rel'=>'seasons',
                    'url'=>"/api/series/{$this->id}/seasons"
                ],
                [
                    'rel'=>'episodes',
                    'url'=>"/api/series/{$this->id}/episodes"
                ],
            ]
        );
    }
}