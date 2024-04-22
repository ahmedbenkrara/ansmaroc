<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\User;
use App\Models\Annonce_images;
use App\Models\Categorie;
use App\Models\Souscat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Signale;

class SearchController extends Controller
{
    public function index(){
        $dataC = CategorieController::getall();
        $dataA = Annonce::where('status',1)->orderBy('updated_at','desc')->paginate(10);
        return view('user.search',compact('dataC','dataA'));
    }

    public function filter($titre = null, $ville = null, $prix = null, $scat = null){
        
        if($titre == " "){
            $titre = null;
        }

        if($ville == " "){
            $ville = null;
        }

        if($prix == " "){
            $prix = null;
        }

        if($scat == " "){
            $scat = null;
        }        

        if($titre == null){
            $titre = '';
        }
        if($ville == null){
            $ville = '';
        }

        $paginate = 10;

        if($prix != null && $scat != null){
            if($prix != '1000'){
                $prix = explode('-',$prix); 
                $result = Annonce::whereBetween('prix',$prix)->where('souscat_id',$scat)->where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);   
            }else{
                $result = Annonce::where('prix','>=',$prix)->where('souscat_id',$scat)->where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);
            }
            
        }else if($prix != null && $scat == null){
            if($prix != '1000'){
                $prix = explode('-',$prix);
                $result = Annonce::whereBetween('prix',$prix)->where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);
            }else{
                $result = Annonce::where('prix','>=',$prix)->where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);
            }
        }else if($prix == null && $scat != null){
            $result = Annonce::where('souscat_id',$scat)->where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);
        }else{
            $result = Annonce::where([['titre','like','%'.$titre.'%'],['ville','like','%'.$ville.'%']])->where('status',1)->paginate($paginate);
        }
        $dataC = CategorieController::getall();
        $dataA = $result;
        $dataA->appends(request()->all());
        return view('user.search',compact('dataC','dataA'));
    }

    public function catfilter($id){
        if($id == 0){
            $dataA = Annonce::where('status',1)->paginate(10);
        }else{
            $dataA = Annonce::join('souscat','annonce.souscat_id','=','souscat.id')
            ->join('categorie','souscat.categorie_id','=','categorie.id')
            ->where('categorie.id',$id)
            ->where('status',1)
            ->select('annonce.*')
            ->paginate(1);
        }
    
        $dataA->appends(request()->all());
        $dataC = CategorieController::getall();
        return view('user.search',compact('dataC','dataA'));
    }

    public function Details($city = null,$slug = null,$id = null){
        if($id != null){

            $dataA = Annonce::find($id);
            if($dataA == null || $dataA->status == 0){
                return redirect('/search');
            }else{
                $suggest = Annonce::where([['souscat_id',$dataA->souscat_id],['id','<>',$dataA->id],['status',1]])->get()->take(9);
                $w = Signale::where('annonce_id',$dataA->id)->count();
                return view('user.details',compact('dataA','suggest','w'));
            }

        }else{
            return redirect('/search');
        }
    }

    public function filterauth(Request $req){
        $filter = $req->get('filter');
        if($filter == -1){
            $dataA = Annonce::where([['status',-1],['user_id',Auth::user()->id]])->paginate(10);
        }else if($filter == 0){
            $dataA = Annonce::where([['status',0],['user_id',Auth::user()->id]])->paginate(10);
        }else{
            $dataA = Annonce::where([['status',1],['user_id',Auth::user()->id]])->paginate(10);
        }
        $dataA->appends($req->all());
        $selected = $req->filter; 
        return view('user.mesannonce',compact('dataA'));
    }

    public function Adetails($id = null){
        if($id == null){
            return redirect('/dashboard');
        }else{
            $dataA = Annonce::find($id);
            if($dataA->status == 0){
                return view('admin.details',compact('dataA'));
            }else{
                return redirect('/dashboard');
            }
        }
    }

    //ans par ville
    public function Bycity($city = null){
        if($city != null){
            $dataA = Annonce::where([['ville',$city],['status',1]])->paginate(10);
        }else{
            $dataA = Annonce::where('status',1)->paginate(10);
        }
        
        return view('user.city',compact('dataA','city'));
    }

}