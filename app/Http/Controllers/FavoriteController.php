<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function create(Request $req){
        $favorite = Favorite::create([
            'user_id' => Auth::user()->id,
            'annonce_id' => $req->annonce
        ]);
        if($favorite){
            return back()->with('status','Annonce enregistrée avec succès');
        }else{
            return back()->with('status','Veuillez réessayer plus tard');
        }
        
    }

    public function read(){
        //SELECT * FROM favorite INNER JOIN annonce ON favorite.annonce_id = annonce.id WHERE favorite.user_id = 4
        $dataA = Annonce::join('favorite','annonce.id','=','favorite.annonce_id')
                 ->where('favorite.user_id',Auth::user()->id)
                 ->select('annonce.*')
                 ->paginate(10);
                 
        return view('user.favorite',compact('dataA'));
    }
}
