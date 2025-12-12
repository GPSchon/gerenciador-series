<x-layout title="Cadastro de Usuário" :successMessage="$messageSucess ?? null">
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail:</label>
            <input id="email" name="email" type="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="name" class="form-label">Nome:</label>
            <input id="name" name="name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Senha:</label>
            <input id="password" name="password" type="password" class="form-control">
        </div>
        <button class="btn btn-primary mt-3" type="submit">Salvar</button>
    </form>
</x-layout>
