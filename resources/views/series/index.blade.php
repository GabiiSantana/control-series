<x-layout title="Séries" :mensagemSucesso="$mensagemSucesso">

    <!-- Link para a tela de criação -->
     @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">
        Adicionar uma nova Série
    </a>
    @endauth

    <ul class="list-group">

        <!-- Percorre todas as séries -->
        @foreach ($series as $serie)

        <li class="list-group-item d-flex justify-content-between align-items-center">

            <!-- Link para visualizar as temporadas -->
            <a href="{{ route('seasons.index', $serie->id) }}">
                {{ $serie->name }}
            </a>

            <!-- Formulário de exclusão -->
            <form action="{{ route('series.destroy', $serie->id) }}" method="post">

                @csrf

                <!-- Simula uma requisição DELETE -->
                @method('DELETE')

                <!-- Link para edição -->
                 @auth
                <a href="{{ route('series.edit', $serie->id) }}"
                   class="btn btn-dark btn-sm">
                    Editar
                </a>

                <!-- Envia o formulário para excluir -->
                <button class="btn btn-danger btn-sm">
                    Excluir
                </button>
                @endauth
            </form>

        </li>

        @endforeach

    </ul>

</x-layout>