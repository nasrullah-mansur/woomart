<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'active_status'];

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_slider_image().$image);
        }

        return null;
    }
}
