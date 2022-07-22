

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
   
<form action="{{route('receivePayment')}}" method='post'>
{{csrf_field()}}
<h4 class="fw-bold text-dark">Payment Here</h4>
    <input type="text" name='paymentId' placeholder="paymentId"   value="{{$receiveData->id}}"class="form-control my-1 w-100">
    <div>
                            @error('paymentId')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    <input type="text" name='Amount'placeholder="Amount"   value="{{$receiveData->Amount}}"class="form-control my-1 w-100">
    <div>
                            @error('Amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

    

    <input type="text" name='Type' placeholder="Type" value="{{$receiveData->Type}} "class="form-control my-1 w-100">
    <div>
                            @error('Type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="d-flex">
                        <div class="ms-auto">
    <input type="submit" value="Receive Payment"class="btn btn-primary btn-sm mt-3">
    </div>
                        </div>
</form>
</div>

</div>
</div>

</div>
@endsection

{{-- @endsection --}}

</html>