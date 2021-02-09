<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function contact()
    {
        return view('emails.contact');
    }

    public function send(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'mail_message' => $request->mail_message,
        ];
        Mail::send('emails.send', $data, function($message) {
            $message->to('admin@testlara.com', 'Wishadmin')->subject('Mail from laravel 5.6 test');
        });

        return redirect('/');
    }
}
