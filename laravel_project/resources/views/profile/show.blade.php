@extends('../layout')

@section('title','プロフィール')

@section('content')
  <div class="profile-wrapper">
    <div class="container">
      <div class="heading">
        <h1>プロフィール</h1>
      </div>
      <div class="profile">
        @if($profile->image)
          <img src="{{ asset('storage/' . $profile->image) }}">
        @else
          <img src="{{ asset('/assets/img/defaultImage.png') }}">
        @endif
        <a href="{{ route('profile.edit', ['user_id' => $user_id]) }}" class="profileEdit">プロフィール編集</a>
        <a href="{{ route('profile.editPassword', ['user_id' => $user_id]) }}" class="passwordEdit">パスワード変更</a>

        <table>
          <tr>
            <td><h2>ユーザー名</h2></td>
            <td><h3>{{$profile->name}}</h3></td>
          </tr>
          <tr>
            <td><h2>性別</h2></td>
            <td><h3>{{\App\Enums\GenderStatus::getGenderStatus($profile->gender)}}</h3></td>
          </tr>
          <tr>
            <td><h2>年齢</h2></td>
            <td><h3>{{$profile->age}}</h3></td>
          </tr>
          <tr>
            <td><h2>自己紹介</h2></td>
            <td><h3>{{$profile->comment}}</h3></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="calendar-wrapper">
    <div class="container">
      <div class="heading">
        <h1>カレンダー</h1>
      </div>
      <div class="calendar">
        <h1>
          <a href="{{ route('profile.show', ['user_id' => $user_id,'dt' => $dt,'change_month' => 'prev']) }}">前月</a>
          <span>{{$dt->year}}年{{$dt->month}}月</span>
          <a href="{{ route('profile.show', ['user_id' => $user_id,'dt' => $dt,'change_month' => 'next']) }}">翌月</a>
        </h1>
        <table class="table table-bordered">
          <thead>
            <tr>
              @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
                <th>{{ $dayOfWeek }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach (array_map(NULL, $dates, $tasks) as [ $date, $task ])
            @if ($date->dayOfWeek == 0)
            <tr>
              @endif
                <td>
                  <a href="{{ route('tasks.index', ['user_id' => $user_id,'date' => $date]) }}">{{ $date->day}}</a></br>
                  @if($task !== '-')
                  {{$task}}%
                  @else
                  {{$task}}
                  @endif
                </td>
              @if ($date->dayOfWeek == 6)
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="graph-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グラフ</h1>
      </div>
      <div class="chartChange">
        <button type="button" class="dayButton">日単位</button>
        <button type="button" class="monthButton">月単位</button>
      </div>
      <div class="oneWeekChart-wrapper">
        <canvas id="oneWeekChart"></canvas>
        <script>
          const $oneWeekTaskDate = @json($oneWeekTaskDate);
          const $oneWeekTaskAchievement = @json($oneWeekTaskAchievement);
          var ctx = document.getElementById("oneWeekChart");
          var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: [$oneWeekTaskDate[0],$oneWeekTaskDate[1],$oneWeekTaskDate[2],$oneWeekTaskDate[3],$oneWeekTaskDate[4],$oneWeekTaskDate[5],$oneWeekTaskDate[6]],
              datasets: [
                {
                  label: 'タスク達成率',
                  data: [$oneWeekTaskAchievement[0],$oneWeekTaskAchievement[1],$oneWeekTaskAchievement[2],$oneWeekTaskAchievement[3],$oneWeekTaskAchievement[4],$oneWeekTaskAchievement[5],$oneWeekTaskAchievement[6]],
                  borderColor: "rgba(255,255,255,1)",
                  backgroundColor: "#4444FF"
                },
              ],
            },
            options: {
              title: {
                display: true,
                text: $oneWeekTaskDate[0]+'  ~  '+$oneWeekTaskDate[6]
              },
              scales: {
                yAxes: [{
                  ticks: {
                    suggestedMax: 100,
                    suggestedMin: 0,
                    stepSize: 10,

                  }
                }]
              },
            }
          });
        </script>
      </div>
      <div class="monthChart-wrapper">
        <canvas id="monthchart"></canvas>
        <script>
          const $monthTaskDate = @json($monthTaskDate);
          const $monthTaskAchievement = @json($monthTaskAchievement);
          var ctx = document.getElementById("monthchart");
          var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: [$monthTaskDate[0],$monthTaskDate[1],$monthTaskDate[2],$monthTaskDate[3],$monthTaskDate[4],$monthTaskDate[5]],
              datasets: [
                {
                  label: 'タスク達成率',
                  data: [$monthTaskAchievement[0],$monthTaskAchievement[1],$monthTaskAchievement[2],$monthTaskAchievement[3],$monthTaskAchievement[4],$monthTaskAchievement[5]],
                  borderColor: "rgba(255,255,255,1)",
                  backgroundColor: "#4444FF"
                },
              ],
            },
            options: {
              title: {
                display: true,
                text: $monthTaskDate[0]+'  ~  '+$monthTaskDate[5]
              },
              scales: {
                yAxes: [{
                  ticks: {
                    suggestedMax: 100,
                    suggestedMin: 0,
                    stepSize: 10,
                  }
                }]
              },
            }
          });
        </script>
      </div>
      <script>
        $(function() {
	        $(".dayButton").click(function() {
		        $(".oneWeekChart-wrapper").css("display", "block");
            $(".monthChart-wrapper").css("display", "none");
	        });
        });

        $(function() {
	        $(".monthButton").click(function() {
		        $(".oneWeekChart-wrapper").css("display", "none");
            $(".monthChart-wrapper").css("display", "block");
	        });
        });
      </script>
    </div>
  </div>
@endsection
