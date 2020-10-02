@extends('../layout')

@section('title','ランキング')

@section('content')
  <div class="ranking-wrapper">
    <div class="container">
      <div class="heading">
        <h1>ランキング</h1>
      </div>
      <div class="rankings">
        <div class="ranking">
          <h1>個人（当日）</h1>
          <table align="center">
              <tr>
                <td>順位</td>
                <td>ユーザー名</td>
                <td>タスク達成率</td>
              </tr>
            @foreach(array_map(null,$personalTodayName, $personalTodayTask, $personalTodayRank) as [$name, $task, $rank])
              <tr>
                <td class="taskRank">{{$rank}}</td>
                <td class="rankName">{{$name}}</td>
                <td class="taskAchievementRate">{{$task}}%</td>
              </tr>
            @endforeach
          </table>
        </div>
        <div class="ranking">
          <h1>個人（1週間）</h1>
          <table align="center">
              <tr>
                <td>順位</td>
                <td>ユーザー名</td>
                <td>タスク達成率</td>
              </tr>
            @foreach(array_map(null,$personalOneWeekName, $personalOneWeekTask, $personalOneWeekRank) as [$name, $task, $rank])
              <tr>
                <td class="taskRank">{{$rank}}</td>
                <td class="rankName">{{$name}}</td>
                <td class="taskAchievementRate">{{$task}}%</td>
              </tr>
            @endforeach
          </table>
        </div>
        <div class="ranking">
          <h1>グループ（当日）</h1>
          <table align="center">
              <tr>
                <td>順位</td>
                <td>ユーザー名</td>
                <td>タスク達成率</td>
              </tr>
            @foreach(array_map(null,$groupTodayName, $groupTodayTask, $groupTodayRank) as [$name, $task, $rank])
              <tr>
                <td class="taskRank">{{$rank}}</td>
                <td class="rankName">{{$name}}</td>
                <td class="taskAchievementRate">{{$task}}%</td>
              </tr>
            @endforeach
          </table>
        </div>
        <div class="ranking">
          <h1>グループ（一週間）</h1>
          <table align="center">
              <tr>
                <td>順位</td>
                <td>ユーザー名</td>
                <td>タスク達成率</td>
              </tr>
            @foreach(array_map(null,$groupOneWeekName, $groupOneWeekTask, $groupOneWeekRank) as [$name, $task, $rank])
              <tr>
                <td class="taskRank">{{$rank}}</td>
                <td class="rankName">{{$name}}</td>
                <td class="taskAchievementRate">{{$task}}%</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
