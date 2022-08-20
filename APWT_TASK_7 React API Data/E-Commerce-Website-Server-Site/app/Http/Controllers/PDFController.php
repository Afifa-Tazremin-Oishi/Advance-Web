<?php

namespace App\Http\Controllers;
use PDF;
use Mail;

use Illuminate\Http\Request;

class PDFController extends Controller
{


    public function invoiceMail()

    {
       

        $data["email"] = "isop667@gmail.com";
        $data["title"] = "From ISOPharma.com";
        $data["body"] = "Test mail";
        $pdf = PDF::loadView('pages.emails.invoice', $data);
        Mail::send('pages.emails.invoice', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
        
      
        return redirect("http://localhost:3000/dashboard");
       
        
    }
}
