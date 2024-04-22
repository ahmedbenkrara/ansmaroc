<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscat extends Model
{
    use HasFactory;

    protected $table = 'souscat';
    protected $primarykey = 'id';
    protected $fillable = [
        'name','categorie_id'
    ];

    public function category(){
        return $this->belongsTo(Categorie::class);
    }

    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

}
