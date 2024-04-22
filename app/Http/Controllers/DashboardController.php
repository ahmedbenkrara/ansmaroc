<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Annonce;

class DashboardController extends Controller
{
    public function index(Request $req){
        if(Auth::user()->hasRole('user')){
            $dataA = Annonce::where([['status',1],['user_id',Auth::user()->id]])->paginate(10);
            $dataA->appends($req->all());
            return view('user.mesannonce',compact('dataA'));
        }else if(Auth::user()->hasRole('admin')){
            $dataA = Annonce::where('status',0)
            ->latest()
            ->paginate(10);
            
            return view('admin.requests',compact('dataA'));
        }
    }
}
