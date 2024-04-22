<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Souscat;
use App\Models\Annonce;

class CategorieController extends Controller
{
    public static function getall(){
        $data = Categorie::all();
        return $data;
    }

    public function index($id = null){
        $data = Categorie::all();
        if($id == null){
            $cat = Categorie::first();
        }else{
            $cat = Categorie::find($id);
            if($cat == null){
                $cat = Categorie::first();
                return view('admin.category',compact('data','cat'));
            }
        }
        return view('admin.category',compact('data','cat'));
    }

    public function edit($id = null){
        if($id != null){
            $res =  Souscat::find($id);
            return response()->json($res);
        }
    }

    public function update(Request $req){
        $souscat = Souscat::find($req->id); 
        if($souscat->name == $req->name){
            $souscat->update([
                'categorie_id' => $req->catid
            ]);
            return back()->with('success','Modifié avec succès');
        }else{
            $a = Souscat::where('name',$req->name)->count();
            if($a == 0){
                $souscat->update([
                    'name' => $req->name,
                    'categorie_id' => $req->catid
                ]);
                
                return back()->with('success','Modifié avec succès');
            }else{
                return back()->with('fail','Le nom existe déjà');
            }
        }
        
    }

    public function delete(Request $req){
        Souscat::find($req->id)->delete();
        return back()->with('success','Supprimé avec succès');
    }

    public function create(Request $req){
        $a = Souscat::where('name',$req->name)->count(); 
        if($a == 0){
            Souscat::create([
                'name' => $req->name,
                'categorie_id' => $req->catid
            ]);
            
            return back()->with('success','Créé avec succès');
        }else{
            return back()->with('fail','Le nom existe déjà');
        }
    }

    public function createcat(Request $req){
        $a = Categorie::where('name',$req->name)->count();
        if($a == 0){
           $image = $req->file('image');
           $imageName = time().random_int(100000, 999999).'.'.$image->extension();
           $image->move(public_path('images/categories'),$imageName);
           $s = Categorie::create([
               'name' => $req->name,
               'icon' => '/images/categories/'.$imageName
           ]);

           if($s){
                return response()->json('Catégorie créée avec succès');
           }else{
                return response()->json("quelque chose n'a pas fonctionné réessayez plus tard");
           }

        }else{
            return response()->json('Le nom existe déjà');
        }
    }

    public function view(){
        $data = Categorie::all();
        return view('admin.categories',compact('data'));
    }

    public function getcat($id = null){
        if($id != null){
            $res =  Categorie::find($id);
            return response()->json($res);
        }
    }

    public function updatecat(Request $req){
        $cat = Categorie::find($req->id);
        if($cat->name == $req->catname){
            if($req->image != null){
                $image = $req->file('image');
                $imageName = time().random_int(100000, 999999).'.'.$image->extension();    
                $image->move(public_path('images/categories'),$imageName);
                $cat->update([
                    'icon' => '/images/categories/'.$imageName
                ]);
            }
            return back()->with('success','Modifiée avec succès');
        }else{
            $a = Categorie::where('name',$req->catname)->count();
            if($a == 0){
                if($req->image != null){
                    $image = $req->file('image');
                    $imageName = time().random_int(100000, 999999).'.'.$image->extension();    
                    $image->move(public_path('images/categories'),$imageName);
                    $cat->update([
                        'name' => $req->catname,
                        'icon' => '/images/categories/'.$imageName
                    ]);
                }else{
                    $cat->update([
                        'name' => $req->catname
                    ]);
                }
                return back()->with('success','Modifié avec succès');
            }else{
                return back()->with('fail','Le nom existe déjà');
            }            
        }
    }

    public function deletecat(Request $req){
        $cat = Categorie::find($req->id);
        
        foreach($cat->souscats as $item){
            $Annonce = Annonce::where('souscat_id',$item->id)->count();
            if($Annonce > 0){
                return back()->with('fail','Vous ne pouvez pas supprimer cette catégorie car elle est liée à de nombreuses annonces !');
            }
        }

        foreach($cat->souscats as $item){
            $item->delete();
        }

        $cat->delete();
        return back()->with('success','Supprimé avec succès');
    }

}
