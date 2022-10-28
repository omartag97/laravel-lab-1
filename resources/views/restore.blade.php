@extends('navbar')

@section('title')
Restore Deleted data
@endsection

@section('content')

<br>
    <div class="d-flex justify-content-center m-3">
    <a href="{{route('posts.index')}}" class="m-3 btn btn-success">All Posts</a>
    <a href="{{route('posts.restore.all')}}" class="m-3 btn btn-success">Restore All</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Deleted At</th>
                <th scope="col">Restore</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($posts as $post )
                <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->deleted_at}}</td>
                <td class="d-flex justify-content-center  ">
                    <form action="{{route('posts.restore',$post->id)}}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" onclick="return confirm('Are you Sure you want to restore post : {{$post->title}}?')" class="m-2 h-75 btn btn-danger">Restore</>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

@endsection
