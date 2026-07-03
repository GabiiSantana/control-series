@component('mail::message')
# {{ $nomeSerie }} criada!

A série {{ $nomeSerie }} com {{ $seasonsQty }} temporadas e {{ $episodesPerSeason }} episódios por temporada foi criada com sucesso!
Acesse por aqui

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver série
@endcomponent
@endcomponent