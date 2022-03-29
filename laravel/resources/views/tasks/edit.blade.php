@extends('layouts.task')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">課題更新</div>
        <div class="card-body">
            <form method='POST' action="{{ route('task.update', ['id' => $task->id]) }}">
                @csrf
                <input type="text" name="timer_id" value="{{ $task->timer_id }}">
                <div class="form-group">
                  <div class="container-fluid p-0">
                    <label for="tag">取り組み時間</label>
                    @if($timer == null)
                      <p id="timer" class="def_timer" style="font-size: 20px;">00:00:00:00</p>
                      <input type="text" name="time" id="timer_hidden" class="def_timer" value="0">
                      <input type="text" name='elapsed_time' id="elapsed_time" class="def_timer">
                    @else
                      <p id="timer" class="def_timer" style="font-size: 20px;">{{ $timer->time }}</p>
                      <input type="text" name="time" id="timer_hidden" class="def_timer" value="{{ $timer->time }}">
                      <input type="text" name='elapsed_time' id="elapsed_time" class="def_timer" value="{{ $timer->elapsed_time }}">
                    @endif
                    <button type="button" id="start" class="btn btn-primary">Start</button>
                    <button type="button" id="stop" class="btn btn-danger">Stop</button>
                    <button type="button" id="reset" class="btn btn-success">Reset</button>
                  </div>
                </div>
                <br>
                <div class="form-group">
                  <label for="tag">課題名</label>
                  <textarea name='name' class="form-control" >{{ $task->name }}</textarea>
                </div>
                <br>
                <input type='hidden' name='user_id' value="{{ Auth::user()->id }}">
                <div class="form-group">
                  <label for="tag">内容</label>
                  <textarea name='content' class="form-control"rows="10">{{ $task->content }}</textarea>
                </div>
                <br>
                <div class="form-group">
                  <label for="tag">タグ</label>
                  <select class='form-control' name='tag_id'>
                @foreach($tags as $tag)
                <option value="{{ $tag['id'] }}" {{ $tag['id'] == $task['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
                <br>
                <button type='submit' id="submit" class="btn btn-primary btn-lg">更新</button>
                <p>ストップウォッチを止めてから更新してください</p>
            </form>
        </div>
    </div>
</div>
@endsection