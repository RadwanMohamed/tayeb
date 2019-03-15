<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'photo', 'price', 'description_ar', 'description_en', 'quantity', 'category_id'];
    function category()
    {
        return $this->belongsTo('App\Category');
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
    public function branches()
    {
        return $this->belongsToMany('App\Branch','brances_products','product_id','branch_id');
    }

}

