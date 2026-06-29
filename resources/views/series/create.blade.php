<x-layout title="Nova Série">

    <!-- Envia o formulário para a rota series.store -->
    <form action="{{ route('series.store') }}" method="post">

        <!-- Token de proteção CSRF -->
        @csrf

        <div class="row mb-3">

            <div class="col-8">

                <label for="name" class="form-label">Nome:</label>

                <!-- old() mantém o valor após erro de validação -->
                <input type="text"
                        autofocus
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name') ?? '' }}">
            </div>

            <div class="col-2">

                <label for="seasonsQty" class="form-label">Temporadas:</label>

                <input type="text"
                        id="seasonsQty"
                        name="seasonsQty"
                        class="form-control"
                        value="{{ old('seasonsQty') ?? '' }}">
            </div>

            <div class="col-2">

                <label for="episodesPerSeason" class="form-label">
                    Episódios por temporada:
                </label>

                <input type="text"
                        id="episodesPerSeason"
                        name="episodesPerSeason"
                        class="form-control"
                        value="{{ old('episodesPerSeason') ?? '' }}">
            </div>

        </div>

        <button type="submit" class="btn btn-dark">
            Enviar
        </button>

    </form>

</x-layout>