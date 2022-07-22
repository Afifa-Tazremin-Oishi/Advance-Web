@extends('layouts.app')
@section('content')

@if(Session::has('manager'))
<center><h3>Welcome {{$manager->name}}</h3></center>
<br>

<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Name: {{$manager->name}}</h4>
<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Email: {{$manager->email}}</h4>
<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Username: {{Session()->get('manager')}}</h4>
<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Gender: {{$manager->gender}}</h4>
<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Phone: {{$manager->phone}}</h4>
<h4 class="d-flex justify-content-center align-items-center bg-success p-2 m-2 text-dark bg-opacity-25">Date Of Birth: {{$manager->dob}}</h4>

<center><a class="btn btn-warning" href="{{route('editManagerInfo')}}"> Update </a> </center>
@endif
@endsection