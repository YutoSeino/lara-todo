@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/user_show.css') }}">
@endpush
@section('content')
<div class="card">
  <div class="photo"></div>
  <div class="banner"></div>
  <ul>
    <li><b>{{ Auth::user()->name }}</b></li>
  </ul>
  <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-lg ">編集</a>
</div>
@endsection
