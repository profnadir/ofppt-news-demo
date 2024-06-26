<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function articles(){
        return $this->morphedByMany(Article::class,'categorieable');
    }

    public function products(){
        return $this->morphedByMany(Product::class,'categorieable');
    }
}
