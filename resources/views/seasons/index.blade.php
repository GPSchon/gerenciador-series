<x-layout title="Temporadas de {{ $series->name }}">
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
</x-layout>
