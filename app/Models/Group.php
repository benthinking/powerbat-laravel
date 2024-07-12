<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    /**
     * The roles that belong to the user.
     */
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
