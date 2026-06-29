<x-layout :title="'Editar Série: ' . $serie->name">

    <!-- Envia os dados para a rota de atualização -->
    <form action="{{ route('series.update', $serie->id) }}" method="post">

        <!-- Token CSRF -->
        @csrf

        <!-- Simula uma requisição PUT -->
        @method('PUT')

        <div class="row mb-3">

            <div class="col-8">

                <label for="name" class="form-label">Nome:</label>

                <!-- Preenche o campo com o nome atual da série -->
                <input type="text"
                        autofocus
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ $serie->name ?? '' }}">
            </div>

            <div class="col-2">

                <label for="seasonsQty" class="form-label">Temporadas:</label>

                <!-- Quantidade de temporadas da série -->
                <input type="text"
                        id="seasonsQty"
                        name="seasonsQty"
                        class="form-control"
                        value="{{ $serie->seasons->count() ?? '' }}">
            </div>

            <div class="col-2">

                <label for="episodesPerSeason" class="form-label">
                    Episódios por temporada:
                </label>

                <!-- Quantidade de episódios da primeira temporada -->
                <input type="text"
                        id="episodesPerSeason"
                        name="episodesPerSeason"
                        class="form-control"
                        value="{{ $serie->seasons->first()?->episodes->count() ?? '' }}">
            </div>

        </div>

        <button type="submit" class="btn btn-dark">
            Enviar
        </button>

    </form>

</x-layout>