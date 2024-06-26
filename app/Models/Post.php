<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'author',
        'body',
        'category_id',
        'language'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
