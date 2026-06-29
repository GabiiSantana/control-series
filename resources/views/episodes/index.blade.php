<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
    <form method="post">
        @csrf
        <ul class="list-group">
            <!-- Percorre todas as temporadas da série -->
            @foreach ($episodes as $episode)

            <li class="list-group-item d-flex justify-content-between align-items-center">
                Episódio {{ $episode->number }}
                <!-- Número da temporada -->
                <input type="checkbox" 
                        name="episodes[]" 
                        value="{{ $episode->id }}"
                        @if ($episode->watched) checked @endif
                        /> 
                <!-- name: quando chegar no back-end ele automáticamente vira um array -->
            </li>

            @endforeach
        </ul>
        <button class="btn btn-dark mt-2 mb-2">Salvar</button>
    </form>
</x-layout>