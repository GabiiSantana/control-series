<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Http\Middleware\Authenticator;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller {
    public function __construct(private SeriesRepository $repository) {
    }
    public function index(Request $request) {
        // Busca todas as séries
        //$series = Series::all();
        $series = Series::paginate(10);

        // Recupera e remove a mensagem da sessão
        $mensagemSucesso = $request->session()->pull('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create() {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {
        $file = $request->file('cover');
        $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('series_cover', 'public'):null;


        $serie = $this->repository->add($request, $coverPath);
        // if (!str_contains($file->getMimeType(), 'image/')) {
        //     $nomeOriginal = $file->getClientOriginalName();    
        //     dd("Esse arquivo não é uma imagem: " . $nomeOriginal);    
        // }
        
        
        $seriesCreatedEvent = new SeriesCreatedEvent(
            $serie->name,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );
        event($seriesCreatedEvent);
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso.");
    }

    public function destroy(Series $series) {
        if ($series->cover) {
            Storage::disk('public')->delete($series->cover);
        }
        // Route Model Binding
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' removida com sucesso.");
    }

    public function edit(Series $series) {

        // Envia a série para o formulário de edição
        return view('series.edit')->with('serie', $series);
    }

    public function update(SeriesFormRequest $request, Series $series) {

        // Atualiza o nome da série
        $series->name = $request->name;
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->name}' editada com sucesso.");
    }
}