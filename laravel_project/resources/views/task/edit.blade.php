<div class="editTask_header">
  <h1>タスク編集</h1>
    <div class="taskEditWrapper">
      <form action="{{ route('tasks.update', ['user_id' => $user_id,'task_id' => $task->id]) }}" method="post">
        {{csrf_field()}}
          <input type="text" name="name" value="{{ $task -> name }}">
          <input type="submit" value="更新" class="btn">
      </form>
    </<div>
</div>