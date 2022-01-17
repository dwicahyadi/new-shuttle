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

        $text .= "\n\n\"Bantu Kami Menjadi Lebih Baik\"";
        $text .= "\n\nJika Pengemudi Kami :";
        $text .= "\n1. Lewat bahu jalan tol";
        $text .= "\n2. Melebihi kecepatan 120 Km/jam";
        $text .= "\n3. Pindah lajur tanpa sein / zigzag";
        $text .= "\n4. Jarak dengan kendaraan lain terlalu dekat";
        $text .= "\n5. Menggunakan HP saat mengemudi";
        $text .= "\n6. Menelepon lebih dari 1 menit";
        $text .= "\n7. Menaikan penumpang di tengah perjalanan";
        $text .= "\n8. Tidak sopan dan kurang ramah";
        $text .= "\n\nMohon Whatsapp ke :";
        $text .= "\nwa.me/6282219437555";

        return  $text;
    }

}
