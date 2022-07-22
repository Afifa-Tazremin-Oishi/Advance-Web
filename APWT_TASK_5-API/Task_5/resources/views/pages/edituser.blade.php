@extends('layouts.app')
@section('content')
@if(Session::has('admin'))
<form action="{{route('adminInfoUpdate')}}" class="col-md-6" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$user->adminId}}">
@endif
@if(Session::has('manager'))
<form action="{{route('managerInfoUpdate')}}" class="col-md-6" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$user->id}}">
@endif
    <div>
        <span>Name</span>
        <input type="text" name="name" value="{{$user->name}}" class="form-control">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div><br>
    <div>
        <span>Email</span>
        <input type="text" name="email" value="{{$user->email}}"class="form-control">
        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div><br>
    <div>
        <span>Phone</span>
        <input type="text" name="phone" value="{{$user->phone}}"class="form-control">
        @error('phone')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div><br>
    <div>
        <span>Username</span>
        <input type="text" name="username" value="{{$user->username}}"class="form-control">
        @error('username')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div><br>
    <div>
        <span>Date of Birth</span>
        <input type="date" name="dob" value="{{$user->dob}}" class="form-control">
        @error('dob')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div><br>
    <div>
        <span>Gender</span><br>
        <input type="radio" id="male" name="gender" value="Male" @if ($user->gender == "Male") checked @endif>
            <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female"  @if ($user->gender == "Female") checked @endif>
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="Other"  @if ($user->gender == "Other") checked @endif>
            <label for="other">Other</label><br>
        @error('gender')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <br>
    <input type="submit" class="btn btn-success" value="Update">
</form>

@endsection