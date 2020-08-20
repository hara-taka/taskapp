@extends('../layout')

@section('title','タスク')

@section('content')
  <div class="personlTask-wrapper">
    <div class="container">
      <div class="heading">
        <h1>タスク(個人) <span>{{$date}} 達成率{{$achievment_rate}}％</span></h1>
      </div>
      <div class="taskCreate">
        <form action="{{ route('tasks.store', ['user_id' => $user_id,'date' => $date]) }}" method="post">
          {{csrf_field()}}
          @error('name')
            <div class="error">{{ $message }}</div>
          @enderror
          <input type="text" name="name" class="createTaskName" placeholder="新規タスクを追加する">
          <select name="status" class="createTaskStatus">
            <option value="1">未完了</option>
            <option value="2">完了</option>
          </select>
          <input type="submit" value="追加" class="btn">
        </form>
      </div>
      <div class="taskIndex">
        <table>
          @foreach($tasks as $task)
              <tr class="task">
                <td class="taskStatus">{{$task->task_status}}</td>
                <td class="taskName"> {{$task->name}}</td>
                <td>
                  <a href="{{ route('tasks.edit', ['user_id' => $user_id,'task_id' => $task->id,'date' => $date ]) }}">編集</a>
                </td>
                <td>
                  <form action="{{ route('tasks.destroy', ['user_id' => $user_id,'task_id' => $task->id,'date' => $date]) }}" method="post">
                    @method('DELETE')
                    {{csrf_field()}}
                    <input type="submit" value="削除">
                  </form>
                </td>
              </tr>
          @endforeach
        </table>
      </div>
      <div class="heading">
        <h1>タスク(グループ)</h1>
      </div>
      <div class="taskIndex_group">
      @foreach($groups as $group)
        <h2>{{$group->group->name}}</h2>
        <h2>{{$groupsTask[$group->group->id]}}%</h2>

        <!--@foreach($groups as $group)
        <h2>{{$group->user_id}}</h2>
        @endforeach-->

      @endforeach



      </div>
    </div>
  </div>
@endsection