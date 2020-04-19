<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="personlTask-wrapper">
  <div class="container">
    <div class="heading">
      <h1>タスク <span>{{$date}} 達成率{{$achievment_rate}}％</span></h1>
    </div>
    <div class="taskCreate">
      <form action="{{ route('tasks.store', ['user_id' => $user_id,'date' => $date]) }}" method="post">
        {{csrf_field()}}
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
  </div>
</div>