<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color_code'];

    public function productColor()
    {
        return $this->hasMany(ProductColor::class, 'color_id','id');
    }
}
