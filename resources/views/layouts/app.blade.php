<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Continous Learning</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="styledbody">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm styled">
            <div class="container">
                <a class="navbar-brand text-light font-weight-bold" href="{{ url('/') }}">
                    Continous Learning..
                </a>
        </nav>
        <main class="py-4">
            <div class="blockk"></div>
            <login-component></login-component>
        </main>
    </div>
</body>
</html>
