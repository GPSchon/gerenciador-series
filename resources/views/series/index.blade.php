<x-layout title="Lista de Séries" :successMessage="$successMessage">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    <ul class="list-group">
        @foreach ($series as $series)
            <li class="list-group-item rowList">
                <a href="{{ route('seasons.index', $series->id) }}" class="flex-grow-1 text-decoration-none">
                    {{ $series->name }}
                </a>
                <span class="d-flex">
                    <a class="btn btn-info btn-sm" style="height: fit-content"
                        href="{{ route('series.edit', $series->id) }}">
                        <x-tabler-edit class="w-6 h-6 text-blue-500" />
                    </a>

                    <form class="ms-2" action="{{ route('series.destroy', $series->id) }}" method="post">

                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <x-tabler-trash class="w-6 h-6 text-red-500" />
                        </button>
                    </form>
                </span>

            </li>
        @endforeach
    </ul>
</x-layout>
