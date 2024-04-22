<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Mail\AdminMail;
use App\Models\Annonce_images;
use Mail;
use App\Models\Signale;

class DemandeController extends Controller
{
    public function demande(Request $req){

        $an = Annonce::find($req->id);
       
        if($req->status == -1){
            $details = [
                'fname' => $an->user->fname,
                'sname' => $an->user->sname,
                'email' => $an->user->email,
                'subject' => 'Votre demande est rejetée',
                'message' => "Il semble que votre annonce ($an->titre) soit contraire aux règles de notre communauté, nous sommes donc désolés d'avoir rejeté votre demande."
            ];
        }else if($req->status == 1){
            $details = [
                'fname' => $an->user->fname,
                'sname' => $an->user->sname,
                'email' => $an->user->email,
                'subject' => 'Votre demande est acceptée',
                'message' => "Votre annonce ($an->titre) est acceptée, elle peut maintenant être affichée. Merci de faire partie de notre communauté."
            ];
        }
        Mail::to($an->user->email)->send(new AdminMail($details));
        if($an != null){
            $an->update([
                'status' => $req->status
            ]);
        }
        return redirect('/dashboard');
    }

    public function delete(Request $req){
        $a = Annonce::find($req->id);
        if($a != null){
            $details = [
                'fname' => $a->user->fname,
                'sname' => $a->user->sname,
                'email' => $a->user->email,
                'subject' => 'Votre annonce a été supprimée',
                'message' => "Votre annonce ($a->titre) a été supprimée car elle semble aller à l'encontre de notre communauté et de nos règles. Merci de votre compréhension."
            ];

            Mail::to($a->user->email)->send(new AdminMail($details));

            $id = $a->id;
            $a->delete();
            Annonce_images::where('annonce_id',$id)->delete();
            Signale::where('annonce_id',$id)->delete();
        }
        return redirect('/search');
    }

    public function view(){
        $signale = Signale::orderBy('created_at','desc')->paginate(10);
        return view('admin.reports',compact('signale'));
    }

    public function signaledelete($id = null){
        $signale = Signale::find($id);
        if($signale != null){
            $signale->delete();
        }
        return redirect('/reports');
    }

}
