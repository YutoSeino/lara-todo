<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/timer.js') }}" defer></script>
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
                <a class='d-block' href="{{ route('task.store', ['id' => Auth::user()->id]) }}">全て表示</a>
                @foreach($tags as $tag)
                <a href="/tasks/{{ Auth::id() }}/?tag={{ $tag->name }}" class='d-block'>{{ $tag->name }}</a>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-md-4 p-0">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">課題一覧 <a class='ml-auto' href="{{ route('task.store', ['id' => Auth::user()->id]) }}">新規作成</a></div>
              <div class="card-body p-2">
              @foreach($tasks as $task)
                <a href="/task/{{ $task->id }}/edit" class='d-block'>{{ $task->name }}</a>
              @endforeach
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