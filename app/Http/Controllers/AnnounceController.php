<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Annonce; 
use Illuminate\Support\Facades\DB;
use App\Models\Annonce_images;
use App\Http\Controllers\CategorieController;
use App\Models\Signale;

class AnnounceController extends Controller
{

    public function index(){
        $cat = CategorieController::getall();
        return view('user.createannounce',compact('cat'));
    }

    public function register(Request $request){
       if(Auth::check()){
        return response()->json('1');
       }else{
       
       $test = User::where('email',$request->email)->first();
       if($test == null){
            $user = User::create([
                'fname' => $request->fname,
                'sname' => $request->sname,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->attachRole('user');
            event(new Registered($user));
            return response()->json('1');
        }else{
            if(!Hash::check($request->password,$test->password)){
                //exist but wrong password
                return response()->json('0');
            }else{
                //exist with correct password
                return response()->json('1');
            }
            
        }

        }
        
    }

    public function create(Request $req){

        $user = User::where('email',$req->email)->first();
        if($user != null){
            if($req->adress == null){
                $req->adress = '';
            }
            $announce = Annonce::create([
                'titre' => $req->titre,
                'description' => $req->description,
                'prix' => $req->prix,
                'ville' => $req->ville,
                'type' => $req->type,
                'status' => '0',
                'adresse' => $req->adress,
                'phone' => $req->phone,
                'user_id' => $user->id,
                'souscat_id' => $req->souscat,
                'meta_title' => ''
            ]);
        
            if($announce != null){
                if(!Auth::check()){
                    Auth::login($user);
                }
                //success
                return response()->json($announce->id);
            }else{
                //something went wrong
                return response()->json('0');
            }
        }else{
            //user doesn't exist
            return response()->json('-1');
        }
    }

    public function img(Request $req){
            $id = $req->id;
            for($i=0;$i<$req->count;$i++){
                $image = $req->file($i);
                $imageName = time().random_int(100000, 999999).'.'.$image->extension();
                $image->move(public_path('images/posts'),$imageName);
                Annonce_images::create([
                    'path'=>'/images/posts/'.$imageName,
                    'annonce_id'=>$id
                ]);
            }
            return response()->json('done');
    }

    public function edit($id = null){
        if($id != null){
            $dataA = Annonce::where([['id',$id],['user_id',Auth::user()->id]])->first();
            if($dataA == null){
                return redirect('/dashboard');
            }
            $cat = CategorieController::getall();
            return view('user.editannonce',compact('dataA','cat'));
        }else{
            return redirect('/dashboard');
        }
    }

    public function update(Request $req){
        if($req->adress == null){
            $req->adress = '';
        }

        $announce = Annonce::find($req->id);
        if($announce != null){
            Annonce::find($req->id)->update([
                'titre' => $req->titre,
                'description' => $req->description,
                'prix' => $req->prix,
                'ville' => $req->ville,
                'type' => $req->type,
                'status' => '1',
                'adresse' => $req->adress,
                'phone' => $req->phone,
                'souscat_id' => $req->souscat
            ]);
            return response()->json('1');
        }else{
            //something went wrong
            return response()->json('0');
        }
    }

    public function updateimage(Request $req){
        $delimages = json_decode($req->delimages);
        $ids = json_decode($req->ids);
        if(count($ids)){
            Annonce_images::whereIn('id',$ids)->delete();
        }

        for($i=0;$i<$req->count;$i++){
            if(in_array($i,$delimages)){
                continue;
            }
            $image = $req->file($i);
            $imageName = time().random_int(100000, 999999).'.'.$image->extension();
            $image->move(public_path('images/posts'),$imageName);
            Annonce_images::create([
                'path'=>'/images/posts/'.$imageName,
                'annonce_id'=>$req->id
            ]);
        }
        return response()->json('1');
    }

    public function delete($id){
        if($id != null){
            $an = Annonce::find($id);
            if($an->user_id == Auth::user()->id){
                $an->delete();
                Annonce_images::where('annonce_id',$id)->delete();
                Signale::where('annonce_id',$id)->delete();
            }
            return redirect('/dashboard');
        }else{
            return redirect('/dashboard');
        }
    }

}
