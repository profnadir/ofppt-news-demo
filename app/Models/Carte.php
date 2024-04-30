<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero',
        'ville_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
