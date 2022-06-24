@extends('layouts.app')
@section('content')
    <table class="table table-border">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
            <th>Delete</th>

        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->address}}</td>
            <td><a class="btn btn-primary px-3"  href="/studentEdit/{{$student->id}}/{{$student->name}}">Edit</a></td>
            <td><a class="btn btn-danger" href="/studentDelete/{{$student->id}}/{{$student->name}}">Delete</a></td>

        </tr>
        @endforeach

    </table>
@endsection