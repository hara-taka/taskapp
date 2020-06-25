<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="{{ route('tasks.index', ['user_id' => $user_id ]) }}">タスク</a></li>
          <li><a href="{{ route('groups.index') }}">グループ</a></li>
          <li><a href="{{ route('ranking.show') }}">ランキング</a></li>
          <li><a href="{{ route('profile.show', ['user_id' => $user_id ]) }}">プロフィール</a></li>
        </ul>
      </nav>
    </header>

    @yield('content')
  </body>
</html>
