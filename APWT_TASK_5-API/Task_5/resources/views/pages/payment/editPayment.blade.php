
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="
    min-height: 100vh;
    width: 100%;
    ">
        <div>
            <div class="form-area">
                <div class="p-4" style=" 
                    border:2px solid white;
                    border-radius: 10px;
                    width: 600px;
                    color: white;
                ">
                
<form action="{{route('sendPayment')}}" method='post'>
{{csrf_field()}}
<h4 class="fw-bold text-dark">Payment Here</h4>
    <input type="text" name='paymentId' placeholder="paymentId"   value="{{$sendData->id}}"class="form-control my-1 w-100">
    <div>
                            @error('paymentId')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    <input type="text" name='Amount'placeholder="Amount"   value="{{$sendData->Amount}}"class="form-control my-1 w-100">
    <div>
                            @error('Amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

    

    <input type="text" name='Type' placeholder="Type" value="{{$sendData->Type}} "class="form-control my-1 w-100">
    <div>
                            @error('Type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="d-flex">
                        <div class="ms-auto">
    <input type="submit" value="Send Payment"class="btn btn-primary btn-sm mt-3">
    </div>
                        </div>
</form>
</div>

</div>
</div>

</div>
@endsection
{{-- @endsection --}}

</body>



</html>