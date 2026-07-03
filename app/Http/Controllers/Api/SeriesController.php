<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller {
    public function __construct(private SeriesRepository $seriesRepository) {

    }
    public function index(Request $request) {
        $query = Series::query();
        if (!$request->has('name')){
            $query->where('name', $request->name);
        }

        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request){
        return response()->json($this->seriesRepository->add($request, null), 201);
    }

    public function show(int $series) {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null){
            return response()->json(['message' => 'Serie not found'], 404);
        }
        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request) {
        // fill() -> Pega todos os dados enviados na requisição e coloca nos campos do objeto $series.
        $series->fill($request->all());
        $series->save();
        return $series;
    }

    public function destroy(int $series) {
        Series::destroy($series);
        return response()->noContent();
    }
}
