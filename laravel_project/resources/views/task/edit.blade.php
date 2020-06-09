@extends('../layout')

@section('title','タスク')

@section('content')
  <div class="editTask_wrapper">
    <div class="container">
      <div class="heading">
        <h1>タスク編集 <span>{{$date}}</span></h1>
      </div>
      <div class="taskEdit">
        <form action="{{ route('tasks.update', ['user_id' => $user_id,'task_id' => $task->id,'date' => $date]) }}" method="post">
          {{csrf_field()}}
          @error('name')
            <div class="error">{{ $message }}</div>
          @enderror
            <input type="text" name="name" value="{{ $task -> name }}" class="editTaskName">
            <select name="status" class="editTaskStatus">
              <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>未完了</option>
              <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>完了</option>
            </select>
            <input type="submit" value="更新" class="btn">
        </form>
      </<div>
  </div>
@endsection