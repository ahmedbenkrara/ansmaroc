<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce_images extends Model
{
    use HasFactory;

    protected $table = 'annonce_images';
    protected $primarykey = 'id';
    protected $fillable = [
        'path','annonce_id'
    ];

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    } 
}
