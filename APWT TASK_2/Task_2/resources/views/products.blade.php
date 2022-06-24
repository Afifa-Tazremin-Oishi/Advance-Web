@extends('layouts.app')
@section('content')

<h1>Product List</h1>


<ul>
@foreach($products as $n)
    <li>{{$n}}</li>
@endforeach
</ul>

@endsection