<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;

class SendEmailController extends Controller
{
    public function index()
    {
        $send_mail = [
            'email' => 'mulyadirizkiputra10@gmail.com'
        ];

        dispatch(new SendEmailJob($send_mail));
        return response()->json([
            'success'   => true,
            'message'   => 'Email Terkirim'
        ], 200);
    }
}
