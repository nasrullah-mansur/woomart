<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFeedback extends Model
{
    use HasFactory;

    protected $fillable =  [ 'name', 'profession', 'image', 'feedback','active_status'];

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_user_image().$image);
        }

        return null;
    }
}
