<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="{{ route('series.index') }}" class="navbar-brand mb-0 h1">{{ env('APP_NAME') }}</a>
        <a href="{{ route('logout') }}" class="navbar-brand mb-0 h1">Sair</a>
    </div>
</nav>

<body>

    <div class="container">
        <h3>{{ $title }}</h3>

        @isset($successMessage)
            <div class="alert alert-success">
                {{ $successMessage }}
            </div>
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </div>
</body>

</html>
