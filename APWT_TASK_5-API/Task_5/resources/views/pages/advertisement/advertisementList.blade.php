<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage</title>
    <style>
        th {
            padding: 0 50px;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 88vh;">
    <div>
        @if(session('advertisement-update'))
        <div class="alert alert-warning w-100 text-center" role="alert">
            <span class="fw-bold"> {{ session('advertisement-update') }}</span>
        </div>
        @endif
        {{-- delete message --}}
        @if(session('advertisement-delete'))
        <div class="alert alert-primary font-weight-bold w-100 text-center" role="alert">
            <span class="fw-bold">
                {{ session('advertisement-delete') }}
            </span>
        </div>
        @endif
        <table class="table table-dark table-sm">
       
 
            <tr class="text-center">
                 <th class="px-4">id</th>
                <th class="px-4">Location</th>
                <th class="px-4">Address</th>
                <th class="px-4">Floor</th>
                <th class="px-4">Details</th>
                
                <th class="px-4">Action</th>
                
            
            @foreach($allAdvertisements as $advertisement)
                    <tr class="text-center">

                        <td class="px-4">{{$advertisement->id}}</td>
                        <td class="px-4">{{$advertisement->Location}}</td>
                        <td class="px-4">{{$advertisement->Address}}</td>
                        <td class="px-4">{{$advertisement->Floor}}</td>
                        <td class="px-4">{{$advertisement->Details}}</td>
                      
                       
                        <td>
                            <!-- <a class="btn  btn-primary btn-sm mt-3" href={{ "verifyAdvertisement/".$advertisement->id }}></a> -->
                            <a class="btn btn-danger btn-sm mt-3" href={{ "deleteAdvertisement/".$advertisement->id }}>Delete</a>
                        </td> 
                    </tr>
            @endforeach
        </table>
      
    </div>
</div>
@endsection

</html>