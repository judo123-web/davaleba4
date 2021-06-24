<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tag;

class Post extends Model
{
    use HasFactory;

    public function morethan10(){
        return Post::where('id','>=',10)->get();
    }

    protected $fillable = [
        'title',
        'author_name',
        'post_text'
    ];


    public function tags() {
        return $this->belongsToMany(\App\Models\Tag::class);
    }

}
