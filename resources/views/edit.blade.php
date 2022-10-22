@extends('navbar')

@section('title')
Create New post
@endsection

@section('content')

<form action="{{route('post.update',$post->id)}}" method="POST">
    @csrf
    @method('POST')
    <label for="title">Title :</label><br>
    <input type="text" id="title" name="title" value="{{$post->title}}"><br><br>
    <label for="body">Body :</label><br>
    <input type="text" id="body" name="body" value="{{$post->body}}"><br><br>
    <input type="submit" value="Submit">
    </form>

@endsection
