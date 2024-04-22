<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorite';
    protected $primarykey = ['user_id','annonce_id'];
    public $incrementing = false;
    protected $fillable = [
        'user_id','annonce_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function annonces(){
        return $this->hasOne(Annonce::class);
    }
}
