<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signale;

class SignalerController extends Controller
{
    public function create(Request $req){
        $s = Signale::create([
            'description' => $req->description,
            'annonce_id' => $req->annonce
        ]);

        if($s){
            return back()->with('signaler','merci d\'avoir signalé cette annonce, nous allons la vérifier dès que possible');
        }else{
            return back()->with('signaler','Réessayez plus tard!');
        }
    }
}
