<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller {
    public function index(Series $series) {
        // Busca as temporadas da série junto com seus episódios
        $seasons = $series->seasons()
            ->with('episodes')
            ->get();

        // Envia os dados para a view
        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $series);
    }
}