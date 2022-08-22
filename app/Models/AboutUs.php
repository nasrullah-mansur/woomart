<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [

        'image','about_us',
        'middle_section_title','middle_section_description',
        'middle_section_content1_icon','middle_section_content1_title','middle_section_content1_description',
        'middle_section_content2_icon','middle_section_content2_title','middle_section_content2_description',
        'middle_section_content3_icon','middle_section_content3_title','middle_section_content3_description'

    ];

    public function getImageAttribute($image)
    {
        if ($image)
        {
            return asset(path_about_us_image().$image);
        }
        return  null;
    }

    public function getMiddleSectionContent1IconAttribute($middle_section_content1_icon)
    {
        if ($middle_section_content1_icon)
        {
            return asset(path_about_us_image().$middle_section_content1_icon);
        }
        return  null;
    }


    public function getMiddleSectionContent2IconAttribute($middle_section_content2_icon)
    {
        if ($middle_section_content2_icon)
        {
            return asset(path_about_us_image().$middle_section_content2_icon);
        }
        return  null;
    }


    public function getMiddleSectionContent3IconAttribute($middle_section_content3_icon)
    {
        if ($middle_section_content3_icon)
        {
            return asset(path_about_us_image().$middle_section_content3_icon);
        }
        return  null;
    }
}
