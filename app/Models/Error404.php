<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error404 extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_error404_image().$image);
        }
        return null;
    }
}
