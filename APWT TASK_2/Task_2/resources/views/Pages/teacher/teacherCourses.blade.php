@extends('layouts.app')
@section('content')
<h1>Teacher Course Details</h1>
    <table class="table table-border">
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Course Code</th>
        </tr>
        @foreach($details as $detail)
        <tr>
            <td>{{$detail->id}}</td>
            <td>{{$detail->c_name}}</td>
            <td>{{$detail->code}}</td>
        </tr>
        @endforeach

    </table>
@endsection