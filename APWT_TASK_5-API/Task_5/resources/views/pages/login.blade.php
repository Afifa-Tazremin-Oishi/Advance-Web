@extends('layouts.app')
@section('content')
    <form action="{{route('login')}}" class="col-md-6" method="post">
        {{csrf_field()}}
            
<div class="d-flex justify-content-center align-items-center" style=""> 
        <div class="col-md-4 form-group">
            <span>Username</span>
            <input type="text" name="username" value="{{old('username')}}"class="form-control">
            @error('username')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
</div>
    
<div class="d-flex justify-content-center align-items-center" style=""> 
        <div class="col-md-4 form-group">
            <span>Password</span>
            <input type="password" name="password" value="{{old('password')}}"class="form-control">
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
</div>
        <br>
        <div class="d-flex justify-content-center align-items-left" style=""> 
        <input type="submit" class="btn btn-success" value="Login" >
</div>
    </form>
@endsection