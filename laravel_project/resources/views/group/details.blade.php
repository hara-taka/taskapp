<div>
  <h1>{{$group->name}}</h1>
  <h1>ジャンル：{{$group->category}}</h1>
  @foreach($members as $member)
  <h1>{{$member->user->name}}</h1>
  @endforeach
  <h1>{{$group->comment}}</h1>
  <form action="{{ route('groups.participate', ['group_id' => $group->id]) }}" method="post">
    {{csrf_field()}}
    @if($group_member_num > 5)
      <h1>定員に達したため参加できません</h1>
    @endif
    <input type="submit" value="このグループに参加する" {{ $group_member_num > 5 ? 'disabled="disabled"' : '' }}>
  </form>
</div>