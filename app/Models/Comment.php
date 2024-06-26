<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'author', 'post_id'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}