<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Continous Learning</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body, html{
            height: 100%;
        }
        .styled{
            background-color: #1c2bff;
            background-image: radial-gradient(circle at 80% 10%, white 5%, transparent 80%),
            radial-gradient(circle at 10% 90%, #000000 25%, transparent);
        }
        .styledbody{
            background-image: url("https://img.freepik.com/free-vector/white-background-with-wavy-lines-copy-space_23-2148822145.jpg?t=st=1646802439~exp=1646803039~hmac=320949bef14a6428de5b552d9bb3c4a94ff72daa4660b2529636a493d019a389&w=740");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .simple-card{
            border: 1px solid black;
            border-radius: 12px;
            padding:20px;
        }
        .blockk{
            padding: 50px;
        /* background-color: #000000; */
        }
        .bottomright {
            position: absolute;
            bottom: 8px;
            right: 16px;
            font-size: 9px;
        }
        .spaceafter{
            padding: 50px;
        }
        @media screen and (max-width : 906px){
        .blockk{
            visibility:hidden;
            display: none;
        }
        }
    </style>
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
            <div class="container">
                <div class="col-md-12 justify-content-center">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="blockk"></div>
                          <h3 class="text-dark text-center font-weight-bold">“Learn continually. There's always “One More Thing” to learn.”<br>— Steve Jobs</h3>
                        <div class="spaceafter"></div>
                      </div>
                    <login-component></login-component>
            </div>
            </div>
        </div>
        </main>
        <footer>
            <a class="bottomright text-dark" href='https://www.freepik.com/vectors/background'>Background vector created by freepik - www.freepik.com</a>
        </footer>
    </div>
</body>
</html>
