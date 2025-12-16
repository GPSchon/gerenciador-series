<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @isset($series)
        @method('PATCH')
    @endisset
    <div class="row mb-2">
        <div class="col-12">
            <label for="cover" style="cursor: pointer;">
                <img id="coverPreview"
                    src="{{ isset($series) && $series->cover ? asset('storage/' . $series->cover) : asset('img/padrao_formImage.png') }}"
                    alt="Preview da capa" style="max-width: 200px; height: auto;">
            </label>

            <input type="file" accept="image/png, image/jpeg, image/gif, image/webp" name="cover" id="cover"
                style="display: none;">
        </div>
    </div>


    <div class="row mb-2">
        <div class="col-8">
            <label class="form-label" for="name">Nome:</label>
            <input class="form-control" type="text" id="name" name="name" autofocus
                @isset($series)value="{{ $series->name }}"@endisset />
        </div>
        <div class="col-2">
            <label class="form-label" for="season">Temporadas:</label>
            <input class="form-control" type="number" id="season" name="season"
                @isset($series)value="{{ $series->Seasons()->count() }}"@endisset />
        </div>
        <div class="col-2">
            <label class="form-label" for="season">Episódios:</label>
            <input class="form-control" type="number" id="episode" name="episode"
                @isset($series)value="{{ $series->numberEpisodesPerSeason() }}"@endisset />
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
