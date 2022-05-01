@extends('layouts.task')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">新規課題作成</div>
        <div class="card-body">
            <form method='POST' action="/task/create">
                @csrf
                <div class="form-group">
                  <label for="tag">課題名</label>
                  <textarea name='name' class="form-control"></textarea>
                </div>
                <br>
                <input type='hidden' name='user_id' value="{{ Auth::user()->id }}">
                <div class="form-group">
                  <label for="tag">内容</label>
                  <textarea name='content' class="form-control"rows="10"></textarea>
                </div>
                <br>
                <div class="form-group">
                  <label for="tag">タグ</label>
                  <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                </div>
                <br>
                <div class="form-grop">
                  <label for="tag">締め切り</label>
                  <input type="datetime-local" id="start" name="start_date" value="today">
                  ~
                  <input type="datetime-local" id="end" name="end_date">
                </div>
                <br>
                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection