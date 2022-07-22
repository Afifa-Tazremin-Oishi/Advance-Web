<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Payoff;
use App\Models\Rent;

class PaymentController extends Controller
{
    //
    public function showList()
    {
        return view('pages.payment.paymentList');
    }
    public function listingPayment(Request $request)
    {
        $this->validate(
            $request,
            [
                'Amount' => 'required|min:4|max:20',
                'Type' => 'required',
                'Date' => 'required',
               
               
            ],
            [
                'Amount.required' => 'Required Field',
                'Type.required' => 'Required Field',
                'Date.required' => 'Required Field',
               
                
            ]
        );

        $payment = new Payment();
        $payment->Amount = $request->Amount;
        $payment->Type = $request->Type;
        $payment->Date = $request->Date;
        
        
        $payment->save();
        $request->session()->flash('payment-added', 'Payment Added!');
        return redirect('addPayment');
    }
    public function sendPayment(Request $request)
    {
        
        $this->validate(
            $request,
            [
                'Amount' => 'required',
                'Type' => 'required',
                'paymentId' => 'required',

               
               
               
            ],
            [
                'Amount.required' => 'Required Field',
                'Type.required' => 'Required Field',
                'paymentId.required' => 'Required Field',
               
                
            ]
        );
        $payment= new Payoff();
        $payment->Amount = $request->Amount;
        $payment->Type = $request->Type;
        $payment->paymentId = $request->paymentId;

      
        
        $payment->save();
        $request->session()->flash('payment-send', 'Payment sent successfully!');
        return redirect('paymentList');
    }
    public function receivePayment(Request $request)
    {
        
        $this->validate(
            $request,
            [
                'Amount' => 'required',
                'Type' => 'required',
                'paymentId' => 'required',

               
               
               
            ],
            [
                'Amount.required' => 'Required Field',
                'Type.required' => 'Required Field',
                'paymentId.required' => 'Required Field',
               
                
            ]
        );
        $payment= new Rent();
        $payment->Amount = $request->Amount;
        $payment->Type = $request->Type;
        $payment->paymentId = $request->paymentId;

      
        
        $payment->save();
        $request->session()->flash('payment-receive', 'Payment received successfully!');
       
        return redirect('paymentList');
    }
    public function allPayment()
    {
        $allPayments = Payment::all();
        return view('pages.payment.addPayment', ['allPayments' => $allPayments]);
    }
    public function paymentList()
    {
        $allPayments = Payment::all();
        return view('pages.payment.paymentList', ['allPayments' => $allPayments]);
    }
   
    function deletePayment(Request $request)
    {
        $payment = Payment::where('id', $request->id)->first();
       
        $payment->delete();

        $request->session()->flash('payment-delete', 'Payment Deleted Successfully!');

        return redirect('paymentList');
    }
    function editPayment($id)
    {
        $sendData = Payment::find($id);
        return view('pages.payment.editPayment',['sendData'=>$sendData]);
    }
    function recPayment($id)
    {
        $receiveData = Payment::find($id);
        return view('pages.payment.receivePaymentList',['receiveData'=>$receiveData]);
    }
   
    
    

}
