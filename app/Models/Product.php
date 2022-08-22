<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','brand','category_id','sub_category_id','price','discount','discount_price','description','primary_image','image2','image3','image4','first_section','second_section','third_section','active_status','is_new','quantity','slug','is_trending','sold', 'about_product'];

    public function getPrimaryImageAttribute($primary_image)
    {
        if ($primary_image)
        {
            return asset(path_product_image().$primary_image);
        }
        return null;
    }


    public function getImage2Attribute($image2)
    {
        if ($image2)
        {
            return asset(path_product_image().$image2);
        }
        return null;
    }

    public function getImage3Attribute($image3)
    {
        if ($image3)
        {
            return asset(path_product_image().$image3);
        }
        return null;
    }

    public function getImage4Attribute($image4)
    {
        if ($image4)
        {
            return asset(path_product_image().$image4);
        }
        return null;
    }


    public function getDiscountAttribute($discunt)
    {
        if ($discunt > 0)
        {
            return $discunt + 0;
        }
        return false;
    }


    public function getIsNewAttribute($is_new)
    {
        if ($is_new)
        {
            return 'new';
        }
        return false;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class,'sub_category_id','id');
    }

    public function productColor()
    {
        return $this->hasMany(ProductColor::class,'product_id','id');
    }

    public function productSize()
    {
        return $this->hasMany(ProductSize::class,'product_id','id');
    }
}
