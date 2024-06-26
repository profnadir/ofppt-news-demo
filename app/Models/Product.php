<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function categories(){
        return $this->morphToMany(Categorie::class,'categorieable');
    }
}
