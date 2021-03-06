<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable =['name', 'city', 'description','name_en', 'city_en', 'description_en'];

    public function products()
    {
        return $this->belongsToMany('App\Product','brances_products','branch_id','product_id');
    }
}
