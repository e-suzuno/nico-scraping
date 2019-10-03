<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>静画掘り出し君</title>

    {{ Html::style('css/layout.css', [], Request::secure()) }}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    @yield('head')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div id="app">
    <header>
        <!-- As a link -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <a class="navbar-brand" href="{{ route("about") }}">静画掘り出し君　てすとばん</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route("index") }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("about") }}">about</a>
                    </li>
                    <li class="nav-item">
                </ul>
            </div>
        </nav>
    </header>

    <main class="clearfix">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer>
        <p>
            超おすすめサイト：<a href="https://seiga.nicovideo.jp/manga/">ニコニコ静画(マンガ)</a>
        </p>
    </footer>
</div>
@section('scripts')

    <script src="{{mix('js/app.js')}}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@show

</body>
</html>
