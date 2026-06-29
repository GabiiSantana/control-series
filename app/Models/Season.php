<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model que representa a tabela seasons
class Season extends Model {

    // Permite usar Factories para gerar dados de teste
    use HasFactory;

    // Campos que podem ser preenchidos com create() e update()
    protected $fillable = ['number'];

    // Uma temporada pertence a uma série
    public function series() {
        return $this->belongsTo(Series::class);
    }

    // Uma temporada possui vários episódios
    public function episodes() {
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes():int {
        return $this->episodes->filter(fn ($episode) => $episode->watched)->count();
    }
}