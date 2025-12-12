<x-layout title="Login">
    <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail:</label>
            <input id="email" class="form-control" type="email" name="email" />
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Senha:</label>
            <input id="password" class="form-control" type="password" name="password" />
        </div>

        <button class="btn btn-primary mt-3" type="submit">
            Entrar
        </button>
        <a href="{{ route('login.create') }}" class="btn btn-secondary mt-3">Cadastrar</a>
    </form>
</x-layout>
