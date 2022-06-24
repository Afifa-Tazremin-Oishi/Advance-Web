@extends('layouts.app')
@section('content')
<h1 class="text-center">Teacher Login</h1>

<div class="row justify-content-center " >
<form action="{{route('teacherLogin')}}" class="form-group col-lg-4 border border-primary shadow-lg p-3 mb-5 bg-body rounded rounded-3  " method="post">
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
</div>
@endsection