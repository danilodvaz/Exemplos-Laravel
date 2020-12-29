<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    {{-- O asset aponta para a pasta public --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
</head>
<body>
    {{-- O yield é semelhante a uma variável. Quando o arquivo é extendido, ele substiui
        o yield pela section com o mesmo nome --}}
    @yield('conteudo')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>