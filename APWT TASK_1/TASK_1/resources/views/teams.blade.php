@extends('layouts.app')
@section('content')

<h1>Our Teams Members</h1>


<ul>
@foreach($teams as $n)
    <li>{{$n}}</li>
@endforeach
</ul>

@endsection