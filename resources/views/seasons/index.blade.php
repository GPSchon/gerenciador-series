<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Temporadas de {{ $series->name }}
        </h2>
    </x-slot>
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item rowList">
                <a href="{{ route('episode.index', $season->id) }}">
                    Temporada {{ $season->number }}
                </a>
                <span class="badge bg-secondary">
                    {{ $season->numberWatchedEpisodes() }} /
                    {{ $season->Episodes->count() }}
                </span>

            </li>
        @endforeach
    </ul>
</x-app-layout>
