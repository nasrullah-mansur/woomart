<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size','chest','shoulder','length','sleeve'];

    public function productSize()
    {
        return $this->hasMany(ProductSize::class, 'size_id','id');
    }
}
