<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use App\Models\Mcu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SendEmailController extends Controller
{
    public function index()
    {
        $mcu = Mcu::select(
                't_mcu.tgl_mcu', 't_mcu.email', 
                (DB::raw('(CASE WHEN t_mcu.jenis = 1 THEN "Pre Employment" WHEN t_mcu.jenis = 2 THEN "Periodik MCU" ELSE "-" END) as desc_jenis')),
                (DB::raw('t_mcu.tgl_mcu + INTERVAL "11" MONTH AS expired_date_akan')),
                (DB::raw('t_mcu.tgl_mcu + INTERVAL "12" MONTH AS expired_date')),
                (DB::raw('(CASE WHEN t_mcu.tgl_mcu + INTERVAL "11" MONTH <= CURDATE() THEN "Expired" ELSE "-" END) AS expired_akan')),
                (DB::raw('(CASE WHEN t_mcu.tgl_mcu + INTERVAL "12" MONTH <= CURDATE() THEN "Expired" ELSE "-" END) AS expired')),
            )->whereRaw('CURDATE() = DATE_ADD(t_mcu.tgl_mcu, INTERVAL 11 MONTH)')
            ->get();
   
        foreach($mcu as $value) {
            $res[] = [
                'email' => $value->email,
            ];

            $send_mail = [
                'email' => 'mul@gmail.com'
            ];

            dispatch(new SendEmailJob($send_mail));
            return response()->json([
                'success'   => true,
                'email'     => $res,
                'message'   => 'Email Terkirim',
                'data'      => $today
            ], 200);
        }
    }
}
