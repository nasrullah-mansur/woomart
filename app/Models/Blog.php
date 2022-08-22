<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['author_id','slug', 'title', 'description', 'image', 'quotation','popular', 'active_status'];

    public function getImageAttribute($image)
    {

        if ($image)
        {
            return asset(path_blog_image().$image);
        }

        return  null;
    }

    public function comment()
    {
        return $this->hasMany(BlogComment::class)->with('reply')->where('parent_id', PARENT);
    }
}
