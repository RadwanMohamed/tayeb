<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutterKind extends Model
{
    protected  $fillable = ['name_ar','description_ar','name_en','description_en'];
//    public function getNameAttribute($value)
//    {
//        if (app()->isLocale('en')) {
//            return $this->attributes['name_en'];
//        } else {
//            return $this->attributes['name_ar'];
//        }
//    }
//    public function getDescriptionAttribute($value)
//    {
//        if(app()->isLocale('en'))
//        {
//            return $this->attributes['description_en'];
//        }
//        else{
//            return $this->attributes['description_ar'];
//        }
//    }
}
