<?php

namespace App\Http\Controllers;
// use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'email' => 'mulyadirizkiputra10@gmail.com',
            'title' => 'Medical Check Up',
            'body'  => $request->body
        ];
        $to = 'mulyadirizkiputra10@gmail.com';

        // dispatch(new SendMailJob($data));
        // return response()->json([
        //     'success'   => true,
        //     'message'   => 'Email Berhasil Terkirim'
        // ], 200);
        Mail::to($to)->send(new SendMail($data));
        return response()->json([
            'success'   => true,
            'message'   => 'Email Berhasil Terkirim'
        ], 200);
    }
}
