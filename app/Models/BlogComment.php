<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'comment',
        'is_reply',
        'parent_id',
        'active_status',
    ];

    public function reply()
    {
        return $this->hasMany(BlogComment::class,'parent_id', 'id');
    }
}
