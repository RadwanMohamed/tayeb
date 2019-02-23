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
}
