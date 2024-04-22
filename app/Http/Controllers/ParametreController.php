<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ParametreController extends Controller
{
    public function index(){
        return view('user.parametre');
    }

    public function update(Request $req){
        if($req->new != null){
            if(!Hash::check($req->old,Auth::user()->password)){
                return response()->json('Mot de passe incorrect !');
            }else{
                User::find(Auth::user()->id)->update([
                    'fname' => $req->fname,
                    'sname' => $req->sname,
                    'password' => Hash::make($req->new)
                ]);
                return response()->json('Modifié avec succès !');
            }
        }else{
            User::find(Auth::user()->id)->update([
                'fname' => $req->fname,
                'sname' => $req->sname
            ]);
            return response()->json('Modifié avec succès !');
        }

    }
}
