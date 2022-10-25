@extends('navbar')

@section('title')
Show data
@endsection

@section('content')
<br>
<div class="d-flex justify-content-center m-3">
    <a href="post/create" class="m-3 btn btn-success">Add New Post</a>
    <a href="{{route('post.archive')}}" class="m-3 btn btn-success">Restore Deleted Posts</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Pagination</th>
                <th scope="col">Title</th>
                <th scope="col">slug</th>
                <th scope="col">Poster</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td> <img width="50px" src="{{asset($post->image)}}"</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at->format('Y-m-d')}}</td>
                <td class="d-flex justify-content-center  ">
                    <a href="{{route('post.show',$post->id)}}" class="m-2 h-75 btn btn-secondary">View</a>
                    <a href="{{route('post.edit',$post->id)}}" class="m-2 h-75 btn btn-primary">Edit</a>
                    <form action="{{route('post.destroy',$post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you Sure you want to delete post : {{$post->title}}?')" class="m-2 h-75 btn btn-danger">Delete</>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center m-3">
    <span>
        {{$posts->links()}}
    </span>
</div>
@endsection

</body>

</html>
