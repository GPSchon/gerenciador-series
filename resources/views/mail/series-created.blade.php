@component('mail::message')
    # A série {{ $seriesName }} foi criada!!

    A série possui {{ $seasons }} temporadas com {{ $episodes }} episódios.

    Acesse aqui:

    @component('mail::button', ['url' => route('seasons.index', $seriesId)])
        Ver série {{ $seriesName }}
    @endcomponent
@endcomponent
