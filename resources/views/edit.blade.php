@extends('navbar')

@section('title')
Create New post
@endsection

@section('content')

<form action="{{route('post.update',$post->id)}}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title :</label><br>
    <input type="text" id="title" name="title" value="{{$post->title}}"><br><br>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="body">Body :</label><br>
    <input type="text" id="body" name="body" value="{{$post->body}}"><br><br>
    @error('body')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <select class="form-control" id="selectUser" name="user_selected" required focus>
        <option value="" disabled selected>Please select user</option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{ $user->name }}</option>
        @endforeach
    </select>

    <input type="submit" value="Update Post">
</form>

@endsection
