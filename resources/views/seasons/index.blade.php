<x-layout :title="'Temporadas de ' . $series->name">

    <ul class="list-group">

        <!-- Percorre todas as temporadas da série -->
        @foreach ($seasons as $season)

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
            Temporada {{ $season->number }}
            </a>
            <!-- Número da temporada -->

            <!-- Quantidade de episódios da temporada -->
            <span class="badge bg-secondary">
                {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>

        </li>

        @endforeach
    </ul>

</x-layout>