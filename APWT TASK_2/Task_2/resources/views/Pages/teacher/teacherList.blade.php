@extends('layouts.app')
@section('content')
<h1>Teacher List</h1>
    <table class="table table-border">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Details</th>
            

        </tr>
        
        <tr>
            <td>{{$teacher->id}}</td>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->email}}</td>
            <td>{{$teacher->phone}}</td>
            <td>{{$teacher->address}}</td>
            <td><a class="btn btn-primary px-3"  href="/teacherCourses/{{$teacher->id}}">Details</a></td>
            
           

        </tr>
        @endforeach

    </table>
@endsection