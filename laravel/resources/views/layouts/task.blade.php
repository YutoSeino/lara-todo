<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @include('nav')
        </nav>

        <main class="py-4">
        <div class="row" style='height: 92vh;'>
            <div class="col-md-2 p-0">
              <div class="card h-100">
              <div class="card-header">タグ一覧</div>
              <div class="card-body py-2 px-4">
                <a class='d-block' href='/'>全て表示</a>
        @foreach($tags as $tag)
                  {{ $tag->name }}
        @endforeach
                </div>
              </div>
            </div>
            <div class="col-md-4 p-0">
              <div class="card h-100">
                <div class="card-header d-flex">課題一覧 <a class='ml-auto' href='/store'><i class="fas fa-plus-circle"></i></a></div>
        @foreach($tasks as $task)
                  {{ $task->name }}
        @endforeach
                <div class="card-body p-2">
                </div>
              </div>    
            </div> <!-- col-md-3 -->
            <div class="col-md-6 p-0">
              @yield('content')
            </div>
          </div>
        </main>
    </div>
</body>
</html>