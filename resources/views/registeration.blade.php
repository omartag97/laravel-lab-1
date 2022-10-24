@extends('navbar')

@section('title')
Registeration Form
@endsection


@section('content')

<form action="{{route('user.store')}}" method="POST">
    @csrf
    @method('POST')

    <fieldset >

    <legend>Registeration Form</legend>
    <div class="mb-3">
        <label for="name" class="form-label">Name :</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your name">

        <br>

        <label for="email" class="form-label">Email :</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your name">

        <br>

        <label for="password" class="form-label">Password :</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your name">
    </div>

    <div class="d-flex d-flex justify-content-center m-3">
        <button type="submit" class="btn btn-primary w-25 align-center">Submit</button>
    </div>

    </fieldset>
</form>

@endsection
