<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected  $fillable =['offer_banner1','offer_banner2','offer_banner3', 'trend_banner1','trend_banner2'];

    public function getOfferBanner1Attribute($offer_banner1)
    {
        if ($offer_banner1)
        {
            return asset(path_banner_image().$offer_banner1);
        }
        return  null;
    }


    public function getOfferBanner2Attribute($offer_banner2)
    {
        if ($offer_banner2)
        {
            return asset(path_banner_image().$offer_banner2);
        }
        return  null;
    }


    public function getOfferBanner3Attribute($offer_banner3)
    {
        if ($offer_banner3)
        {
            return asset(path_banner_image().$offer_banner3);
        }
        return  null;
    }


    public function getTrendBanner1Attribute($trend_banner1)
    {
        if ($trend_banner1)
        {
            return asset(path_banner_image().$trend_banner1);
        }
        return  null;
    }


    public function getTrendBanner2Attribute($trend_banner2)
    {
        if ($trend_banner2)
        {
            return asset(path_banner_image().$trend_banner2);
        }
        return  null;
    }

}
