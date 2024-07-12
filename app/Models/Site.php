<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the comments for the blog post.
     */
    public function points()
    {
        return $this->hasMany(Point::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
