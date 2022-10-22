@extends('navbar')

@section('title')
View data
@endsection


@section('content')

<div class="card">
    <div class="card-header">
      Post Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Title : {{$post->title}}</h5>
      <h5 class="card-title">descreption : {{$post->body}}</h5>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      Post Creator Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Name : {{$post->users->name}}</h5>
      <h5 class="card-title">Email : {{$post->users->email}}</h5>
      <h5 class="card-title">Created at : {{$post->users->created_at}}</h5>
    </div>
  </div>

@endsection
