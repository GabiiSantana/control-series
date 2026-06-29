<?php 
namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController {
    public function index(Season $season) { // session() buscanco um dado da sessão 
        return view('episodes.index', ['episodes' => $season->episodes, 'mensagemSucesso' => session('mensagem.sucesso')]);
    }

    public function update(Request $request, Season $season) {
        // Pega episódios assistidos
        $watchedEp = $request->episodes;
        // Para cada um desses episódios da temporada:
        $season->episodes->each(function (Episode $episode) use ($watchedEp) {
            // marcando o episódio como assistido se o id dele estiver no array de episódios
            $episode->watched = in_array($episode->id, $watchedEp);
            $episode->save(); // ir no banco de dados e salvar
        });

        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', "Episódios marcados como assistidos.");
    }
}