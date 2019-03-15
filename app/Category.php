<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'photo', 'description_ar', 'description_en'];

    public function products()
    {
        return $this->hasMany("App\Product");
    }

    public function getPhotoAttribute($value)
    {
        return "img/".$value;
    }

    public function getNameAttribute($value)
    {
        if (app()->isLocale('en')) {
            return $this->attributes['name_en'];
        } else {
            return $this->attributes['name_ar'];
        }
    }
    public function getDescriptionAttribute($value)
    {
        if(app()->isLocale('en'))
        {
            return $this->attributes['description_en'];
        }
        else{
            return $this->attributes['description_ar'];
        }
    }
}
