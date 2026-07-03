<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller {
    public function index(Series $series){
        return $series->episodes;
        // mostra todos os episódios da série independente da temporada
    }
}
