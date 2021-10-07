<?php

namespace App\Helpers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Http;

class WAHelper
{

    public static function send($phone, $msg)
    {
        $send = Http::post('https://console.zenziva.net/wareguler/api/sendWA/',[
            'userkey' => 'c3y06u',
            'passkey' => 'e0dmk6hcl6',
            'to' => $phone,
            'message' => $msg
        ]);

        return $send;
    }

    public static function msgBuilder(Reservation $reservation)
    {
        $text = "*".config('app.name', 'Shuttle')."* \n*{$reservation->code}*\n\n";
        $text .= "Berikut adalah rincian Tiket anda \n";
        foreach($reservation->tickets as $ticket)
        {
            $text .= "\nTanggal : *{$ticket->date}*";
            $text .= "\nJam : *{$ticket->departure->time}*";
            $text .= "\nKeberangkatan : *{$ticket->departure_point->city->name} - {$ticket->departure_point->name}*";
            $text .= "\nTujuan : *{$ticket->departure->arrival_point->city->name} - {$ticket->departure->arrival_point->name}*";
            $text .= "\nSeat : *{$ticket->seat}*\n\n";
        }

        $text .= "Tiket dapat dilihat di ".route('self_print',['reservation'=>$reservation])."\n\n";
        $text .= "NB: Jangan balas pesan ini. Untuk informasi silakan hubungi WA CS. wa.me/6287721217999";

        return  $text;
    }

}
