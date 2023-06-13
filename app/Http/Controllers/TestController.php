<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        \Mail::send('mail.reply_body', [], function ($message) {
            $message->from('tawhid8995@gmail.com', 'VVMETHOD')
                    ->to('test@icarjapan.com')
                    ->subject('Test');
        });
        
    }
}
