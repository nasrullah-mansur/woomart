<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description','parent_id', 'active_status', 'top_category', 'image', 'icon'];


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id')->with('parent');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('active_status', STATUS_ACTIVE)->with('child');
    }


    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_category_image(). $image);

        }
            return null;

    }


    public function getIconAttribute($icon)
    {
        if ($icon)
        {
            return asset(path_category_image(). $icon);

        }
            return null;

    }



}
