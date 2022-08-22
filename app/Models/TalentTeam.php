<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentTeam extends Model
{
    use HasFactory;

    protected $fillable = ['name','designation', 'image', 'active_status'];

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_talent_team_image().$image);
        }
        return null;
    }
}
