<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Mail;

class MailController extends Controller
{

    public function contact(){
        return view('user.contact');
    }

    public function send(Request $req){
        $details = [
            'fname' => $req->fname,
            'sname' => $req->sname,
            'email' => $req->email,
            'subject' => $req->subject,
            'message' => $req->message
        ];

        Mail::to('ahmed.benkrara11@gmail.com')->send(new SendMail($details));
        if(Mail::failures()){
            return back()->with('fail','Quelque chose s\'est mal passé!');
        }
        return back()->with('success','E-mail envoyé avec succès...');
    }

}
