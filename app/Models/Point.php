<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    /**
     * Get the post that owns the comment.
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
