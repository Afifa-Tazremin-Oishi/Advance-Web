@extends('layouts.app')
@section('content')
<h1>Customer Login</h1>

<form action="{{route('loginForm')}}" class="form-group" method="post">
{{csrf_field()}}

        <label for="">Email</label>
        <input type="email" name="email" id="" value="{{old('email')}}" class="form-control">
        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <br>

        <label for="">Password</label>
        <input type="password" name="password" id="" value="{{old('password')}}" class="form-control">
        @error('password')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <br>

        <input type="submit">

</form>
@endsection