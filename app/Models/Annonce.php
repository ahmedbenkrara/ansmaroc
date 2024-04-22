<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $table = 'annonce';
    protected $primarykey = 'id';
    protected $fillable = [
        'titre','description','prix','ville','type','status','adresse','user_id','souscat_id','phone','meta_title'
    ];

    public function souscat(){
        return $this->belongsTo(souscat::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function images(){
        return $this->hasMany(Annonce_images::class);
    }

    public function signales(){
        return $this->hasMany(Signale::class);
    }

    public function fav(){
        return $this->belongsTo(Favorite::class);
    }
}
