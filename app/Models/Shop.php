<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['banner', 'active_status'];

    public function getBannerAttribute($banner)
    {

        if ($banner)
        {
            return asset(path_shop_banner_image().$banner);
        }
        return  null;
    }
}
