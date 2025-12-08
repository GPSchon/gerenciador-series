<x-layout title="Temporadas de {{$series->name}}">
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item rowList">
                Temporada {{$season->number}}
                <span class="badge bg-secondary">
                    {{$season->Episodes->count()}}
                </span>

            </li>
        @endforeach
    </ul>
</x-layout>
