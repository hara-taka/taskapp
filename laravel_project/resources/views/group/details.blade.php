@extends('../layout')

@section('title','グループ')

@section('content')
  <div class="groupDetails-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グループ詳細</h1>
      </div>
      <div class="groupDetails">
        <table class="groupDetailsTable">
          <tr>
            <td><h2>グループ名</h2></td>
            <td><h3>{{$group->name}}</h3></td>
          </tr>
          <tr>
            <td><h2>ジャンル</h2></td>
            <td><h3>{{$group->category}}</h3></td>
          </tr>
          <tr>
            <td><h2>グループ紹介</h2></td>
            <td><h3>{{$group->comment}}</h3></td>
          </tr>
        </table>

        <table class="taskTable">
          <tr>
            <td class="taskTable_name">グループ参加</br>ユーザー</td>
            <td class="taskTable_task">タスク達成率</td>
            <td class="taskTable_taskNum">タスク数</br>(達成タスク/全タスク)</td>
          </tr>
        </table>

        <div class="groupDetailsTask_wrapper">
          <div>
            @foreach($members as $member)
            @if($member->user->image)
              <img src="{{ asset('storage/' . $member->user->image) }}"><h1>{{$member->user->name}}</h1>
            @else
              <img src="{{ asset('/assets/img/defaultImage.png') }}"><h1>{{$member->user->name}}</h1>
            @endif
            @endforeach
          </div>
          <div>
            @if($groupInfo !== null)
            @foreach($groupInfo as $task)
              <h2>{{$task}}%</h2>
            @endforeach
            @endif
          </div>
          <div>
            @if($groupMemberTaskNum !== null)
            @foreach($groupMemberTaskNum as $num)
              <h2>{{$num}}</h2>
            @endforeach
            @endif
          </div>

        </div>

        <form action="{{ route('groups.participate', ['group_id' => $group->id]) }}" method="post">
          {{csrf_field()}}
          @if($group_member)
            <input type="submit" class="btn" value="参加済のグループです" disabled="disabled">
          @elseif($group_member_num > 4)
            <input type="submit" class="btn" value="グループの定員に達しています" disabled="disabled">
          @else
            <input type="submit" class="btn" value="このグループに参加する">
          @endif
        </form>
      </div>
    </div>
  </div>

@endsection