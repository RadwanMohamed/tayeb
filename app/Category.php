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
}
