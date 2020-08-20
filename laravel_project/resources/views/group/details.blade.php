@extends('../layout')

@section('title','グループ')

@section('content')
  <div class="groupDetails-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グループ詳細</h1>
      </div>
      <div class="groupDetails">
        <h1>グループ名:{{$group->name}}</h1>
        <h1>ジャンル:{{$group->category}}</h1>
        @foreach($members as $member)
          @if($member->user->image)
            <img src="{{ asset('storage/' . $member->user->image) }}"><h1>{{$member->user->name}}</h1>
          @else
            <img src="{{ asset('/assets/img/defaultImage.png') }}"><h1>{{$member->user->name}}</h1>
          @endif
        @endforeach

        @if($groupInfo !== null)
          @foreach($groupInfo as $task)
            <h2>{{$task}}</h2>
          @endforeach
        @endif

        @if($groupMemberTaskNum !== null)
          @foreach($groupMemberTaskNum as $num)
            <h2>{{$num}}</h2>
          @endforeach
        @endif


        <h1>グループ紹介</h1>
        <h2>{{$group->comment}}</h2>
        <form action="{{ route('groups.participate', ['group_id' => $group->id]) }}" method="post">
          {{csrf_field()}}
          @if($group_member_num > 4)
            <h1>定員に達したため参加できません</h1>
          @endif
          <input type="submit" class="btn" value="このグループに参加する" {{ $group_member_num > 4 ? 'disabled="disabled"' : '' }}>
        </form>
      </div>
    </div>
  </div>

@endsection