@extends('navbar')

@section('title')
Show data
@endsection

@section('content')
      <br>
      <div class="d=flex justify-content-center">
      <a href="post/create" class="btn btn-success">Add New Post</a>
      </div>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Pagination</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($posts as $post )
                <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <a href="{{route('post.show',$post->id)}}" class="btn btn-secondary">View</a>
                    <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('post.delete',$post->id)}}" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                @endforeach

            </tbody>
          </table>
    </div>
    @endsection

  </body>
</html>
