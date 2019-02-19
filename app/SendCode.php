<?php

namespace App;

use Illuminate\Support\Facades\Hash;

class SendCode
{
    public static function sendCode($phone) {
        $code = rand(1111,9999);
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'    =>  '+55'.(int)$phone,
            //'from'  =>  '+5562999338069',
            'from'  =>  '+55'.(int)$phone,
            'text'  =>  'Codigo de Ativacao: '.$code,
        ]);
        return $code;
    }


    public static function sendReset($phone) {
        $senhaToken = rand(11111111,99999999);
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to'    =>  '+55'.(int)$phone,
            'from'  =>  '+5562999338069',
            'text'  =>  'Codigo de Recuperacao: '.$senhaToken,
        ]);
        return $senhaToken;
    }
}
