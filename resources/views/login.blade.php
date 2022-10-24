@extends('navbar')

@section('title')
Login Form
@endsection


@section('content')

<form action="{{route('user.handlelogin')}}" method="POST">
    @csrf
    @method('POST')

    <fieldset >

    <legend>Login Form</legend>

    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" name="email" class="form-control" >

        <br>

        <label for="password" class="form-label">Password :</label>
        <input type="password" name="password" class="form-control" >
    </div>

    <div class="d-flex d-flex justify-content-center m-3">
        <button type="submit" class="btn btn-primary w-25 align-center">Submit</button>
    </div>

    </fieldset>
</form>

@endsection
