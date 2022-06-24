<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Provider Dashboard</title>

    <style>
        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    @extends('../../layouts.app')
    @section('content')
    <div class="row">
        <div class="col-3" style="min-height: 88vh; background-image: linear-gradient(45deg,  #3D0000,#0b006e)">
            @include('pages.serviceProvider.serviceProviderSideBar')
        </div>
        <div class="col-9">
            {{-- message --}}
            <div class="text-center">
                @if(session('image-added'))
                <div class="mt-3 fw-bold d-flex justify-content-center align-items-center"
                    style="height: 30px; font-size:13px; color:red; padding:10px; width:100%; background: black; border-radius: 20px">
                    {{ session('image-added') }}
                </div>
                @endif
                @if(session('image-update'))
                <div class="mt-3 fw-bold d-flex justify-content-center align-items-center"
                    style="height: 30px; padding:10px;font-size:13px; width:100%;color:red; background:black; border-radius: 20px">
                    {{ session('image-update') }}
                </div>
                @endif
                @if(session('serviceProvider-info-update'))
                <div class="mt-3 fw-bold d-flex justify-content-center align-items-center"
                    style="height: 30px; font-size:13px; color:red; padding:10px; width:100%; background: black; border-radius: 20px">
                    {{ session('serviceProvider-info-update') }}
                </div>
                @endif
            </div>
            <div class="row" style="height: 90vh;">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 90vh;">
                        <div class="p-5"
                            style="border-radius: 10px; background: #EFE3D0; height: 400px;width:430px ;box-shadow: 3px 3px 10px gray;">
                            <h4 class="mb-5 fw-bold text-danger text-uppercase">Profile Picture</h4>
                            <img src="{{ asset('uploads/serviceProviderProfile/'.$serviceProvider->image) }}" alt="{{ $serviceProvider->name }}"
                                width="130px" height="160px">
                            @if($serviceProvider->image == '')
                            <form action="{{route('serviceProviderDashboard')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="file" name="image" class="form-control w-100">
                                <div>
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <input type="text" hidden name="id" value="{{ $serviceProvider->id }}">
                                <input type="text" hidden name="name" value="{{ $serviceProvider->name }}">
                                <input type="text" hidden name="role" value="{{ $serviceProvider->role }}">
                                <input type="text" hidden name="email" value="{{ $serviceProvider->email }}">
                                <input type="text" hidden name="password" value="{{ $serviceProvider->password }}">
                                <input type="text" hidden name="address" value="{{ $serviceProvider->address }}">
                                <input type="text" hidden name="phone" value="{{ $serviceProvider->phone }}">
                                <input type="text" hidden name="status" value="{{ $serviceProvider->status }}">
                                <button type="submit" class="btn btn-primary btn-sm mt-3">Set Photo</button>
                            </form>
                            @else
                            <br>
                            <h5 class="fw-bold mt-2">{{ $serviceProvider->name }}</h5>
                            <a href="{{ 'changeServiceProviderImage/'.$serviceProvider->id }}" class="btn btn-danger btn-sm mt-3">Change
                                Photo</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 90vh;">
                        <div class="p-5"
                            style="border-radius: 10px; background: #EFE3D0; height: 400px; width:430px; box-shadow: 3px 3px 10px gray;">
                            <h4 class="mb-5 fw-bold text-danger text-uppercase">Your Information</h4>
                            <div class="h5 fw-bold my-3 form-control">
                                Name : {{ $serviceProvider->name }}
                            </div>
                            <div class="h5 fw-bold  my-3 form-control">
                                Email : {{ $serviceProvider->email }}
                            </div>
                            <div class="h5 fw-bold  my-3 form-control">
                                Phone : {{ $serviceProvider->phone }}
                            </div>
                            <div class="h5 fw-bold  my-3 form-control">
                                Address : {{ $serviceProvider->address }}
                            </div>
                            <div>
                                <a href={{ "editServiceProviderProfile/" .$serviceProvider->id}} class="btn btn-warning btn-sm">Edit
                                    Profile</a>
                                    <button style="margin-left: 130px" type="button" class="btn btn-danger btn-sm"
                                data-toggle="modal" data-target="#exampleModal">
                                Delete Account
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Acount Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                           <span class=" fw-bold text-danger"> Are You Sure ?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger btn-sm" href={{ "deleteServiceProviderAccount/"
                                                .$serviceProvider->id }}>Delete Account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection
</body>

</html>