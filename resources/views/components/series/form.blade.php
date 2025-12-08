<form action="{{ $action }}" method="post">
    @csrf
    @if($update)
        @method('PATCH')
    @endif
    <div class="row mb-2">
        <div class="col-8">
            <label class="form-label" for="name">Nome:</label>
            <input
                class="form-control"
                type="text"
                id="name"
                name="name"
                autofocus
                @isset($name)value="{{$name}}"@endisset/>
        </div>
        <div class="col-2">
            <label class="form-label" for="season">Temporadas:</label>
            <input
                class="form-control"
                type="number"
                id="season"
                name="season"/>
        </div>
        <div class="col-2">
            <label class="form-label" for="season">Episódios:</label>
            <input
                class="form-control"
                type="number"
                id="episode"
                name="episode"/>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
