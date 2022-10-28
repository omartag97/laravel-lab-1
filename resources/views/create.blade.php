@extends('navbar')

@section('title')
Create New post
@endsection

@section('content')

<form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <label for="title">Title :</label><br>
    <input type="text" id="title" name="title"><br><br>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="body">Body :</label><br>
    <input type="text" id="body" name="body"><br><br>
    @error('body')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="image">Poster :</label><br>
    <input type="file" name="image"><br><br>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <select class="form-control" id="selectUser" name="user_id" required focus>
        <option value="" disabled selected>Please select user</option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{ $user->name }}</option>
        @endforeach
    </select>

    <br>

    <input type="submit" value="Add Post">
</form>

@endsection
