<x-layout title="Episódios">
    <form action="{{ route('episode.update', $episodes[0]->seasons_id) }}" method="POST">
        @csrf
        @method('PATCH')
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item rowList">
                    Episódio {{ $episode->number }}

                    <input type="checkbox" name="episodes[]" value="{{ $episode->id }}" @checked($episode->watched) />
                </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-primary mt-2 bt-2">Salvar</button>
    </form>
</x-layout>
