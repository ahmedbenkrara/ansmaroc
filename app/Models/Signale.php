<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signale extends Model
{
    use HasFactory;
    protected $table = 'signale';
    protected $primarykey = 'id';
    protected $fillable = [
        'description','annonce_id'
    ];

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
}
