<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsSetting extends Model
{
    use HasFactory;

    protected  $fillable = ['contact_title','why_contact','form_title','address','phone','email','site_url'];
}
