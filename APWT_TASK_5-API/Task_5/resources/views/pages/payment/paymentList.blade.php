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
        @if(session('payment-update'))
        <div class="alert alert-warning w-100 text-center" role="alert">
            <span class="fw-bold"> {{ session('payment-update') }}</span>
        </div>
        @endif
        {{-- delete message --}}
        @if(session('payment-delete'))
        <div class="alert alert-primary font-weight-bold w-100 text-center" role="alert">
            <span class="fw-bold">
                {{ session('payment-delete') }}
            </span>
        </div>
        @endif
        @if(session('payment-send'))
        <div class="alert alert-primary font-weight-bold w-100 text-center" role="alert">
            <span class="fw-bold">
                {{ session('payment-send') }}
            </span>
        </div>
        @endif
        @if(session('payment-receive'))
        <div class="alert alert-primary font-weight-bold w-100 text-center" role="alert">
            <span class="fw-bold">
                {{ session('payment-receive') }}
            </span>
        </div>
        @endif
        <table class="table table-dark table-sm">
       
 
            <tr class="text-center">
                 <th class="px-4">id</th>
                <th class="px-4">Amount</th>
                <th class="px-4">Type</th>
                <th class="px-4">Date</th>
               
                <th class="px-4">Action</th>
            </tr>
            @foreach($allPayments as $payment)
                    <tr class="text-center">

                        <td class="px-4">{{$payment->id}}</td>
                        <td class="px-4">{{$payment->Amount}}</td>
                        <td class="px-4">{{$payment->Type}}</td>
                        <td class="px-4">{{$payment->Date}}</td>
                    
                      
                       
                        <td>
         <a class="btn  btn-primary btn-sm mt-3" href={{ "sendPayment/".$payment->id }}>Send</a>
         <a class="btn  btn-success btn-sm mt-3" href={{ "receivePayment/".$payment->id }}>Receive</a>
         <a class="btn btn-danger btn-sm mt-3" href={{ "deletePayment/".$payment->id }}>Delete</a>
                           
                        </td> 
                        
                    </tr>
            @endforeach
        </table>
        
    </div>
</div>
@endsection


</html>