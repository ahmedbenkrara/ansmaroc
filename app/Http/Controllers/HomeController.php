<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Souscat;
use App\Models\Annonce;

class HomeController extends Controller
{
    //get categories and last 10 posts
    public function getCT(){
       $dataC = CategorieController::getall();
       $suggest = Annonce::where('status',1)->orderBy('created_at','desc')->get()->take(10);
       return view('user.home',compact('dataC','suggest'));
    }

    public function settings(){
        $data = json_decode(file_get_contents(public_path('/json/seo.json'),true));
        return view('admin.seo',compact('data'));
    }

    public function update(Request $req){
        $data = json_decode(file_get_contents(public_path('/json/seo.json'),true));
        $data->title = $req->title;
        $data->author = $req->author;
        $data->keywords = $req->keywords;
        $data->description = $req->description;
        $data->whatsapp = $req->whatsapp;
        $data->facebook = $req->facebook;
        $data->twitter = $req->twitter;
        $data->instagram = $req->instagram;
        $data->address = $req->address;
        $data->phone = $req->phone;
        $data->map = $req->map;
        $new = json_encode($data,JSON_PRETTY_PRINT);
        file_put_contents(public_path('/json/seo.json'),$new);
        return back()->with('success','Mis à jour avec succés');
    }

    public static function title(){
        $data = json_decode(file_get_contents(public_path('/json/seo.json'),true));
        return $data;
    }

    public function setTitle(Request $req){
        if($req->meta_title != null){
            $res = Annonce::find($req->id)->update([
                'meta_title' => $req->meta_title
            ]);
        }else{
            $res = Annonce::find($req->id)->update([
                'meta_title' => ""
            ]);
        }

        if($req){
            return back()->with('status','Mis à jour avec succés');
        }else{
            return back()->with('status','Échec de mise à jour !');
        }
    }

    public static function category(){
        $data = Souscat::all();
        $cats = "";
        foreach($data as $item){
            $cats .= $item->name.', ';
        }
        return $cats;
    }

    
}
