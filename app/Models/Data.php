<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    /**
     * Get the comments for the blog post.
     */
    public function points()
    {
        return $this->belongsTo(Point::class);
    }
}
