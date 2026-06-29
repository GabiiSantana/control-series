<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticator;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Series;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller {
    public function __construct(private SeriesRepository $repository) {
    }
    public function index(Request $request) {
        // Busca todas as séries
        $series = Series::all();

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
        $serie = $this->repository->add($request);
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso.");
    }

    public function destroy(Series $series) {

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