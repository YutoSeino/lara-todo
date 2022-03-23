@extends('layouts.task')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">課題更新</div>
        <div class="card-body">
            <form method='POST' action="{{ route('task.update', ['id' => Auth::user()->id]) }}">
                @csrf
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
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection