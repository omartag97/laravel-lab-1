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
      <h5 class="card-title">Name : {{$post->user->name}}</h5>
      <h5 class="card-title">Email : {{$post->user->email}}</h5>
      <h5 class="card-title">Created at : {{$post->user->created_at}}</h5>
    </div>
  </div>

    <div class="card">
        <div class="card-header">
            Users Comments
        </div>
        <div class="card-body">
            <form action="{{route('posts.storeComment',$post->id)}}" method="POST" class="form-horizontal">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="comment" class="col-sm-3 control-label"> Comments </label>
                    <br><br>

    {{-- @if (count($comments) > 0) --}}
    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <tbody>
                    @foreach ($posts as $post)
                    @foreach ($post->comments as $comment)
                        <tr>
                            <td>
                                {{$post->user->name}} :
                            </td>
                            <td class="table-text">
                                <div>{{ $comment->comment}}</div>
                            </td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{-- @endif --}}

    <div class="col-sm-6">
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>
                    <br>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add comment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
