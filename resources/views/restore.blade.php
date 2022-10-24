@extends('navbar')

@section('title')
Restore Deleted data
@endsection

@section('content')

<br>
    <div class="d-flex justify-content-center m-3">
    <a href="{{route('post.index')}}" class="m-3 btn btn-success">All Posts</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">deleted At</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($posts as $post )
                <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->deleted_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    </div>

@endsection
