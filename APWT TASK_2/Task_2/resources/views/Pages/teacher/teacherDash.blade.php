@extends('layouts.app')
@section('content')

@if (Session::get("user")) 
<h6>Hi...{{Session::get ("user")}}</h6>
<div>
<a class="btn btn-danger" href="{{route("teacherLogout")}}">Logout </a>
</div>

@endif

@endsection