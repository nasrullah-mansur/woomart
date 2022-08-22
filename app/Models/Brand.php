<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected  $fillable = [ 'name', 'image','slug', 'active_status'] ;

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_brand_image().$image);
        }
        else
            return null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            $brand->slug = Str::slug(time().'-'.$brand->name,'-');
        });

        static::updating(function ($brand) {
            $brand->slug = Str::slug(time().'-'.$brand->name,'-');
        });

    }
}
