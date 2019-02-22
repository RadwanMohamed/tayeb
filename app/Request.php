<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const  NEW   = 'new';
    const  READY = 'ready';
    protected  $fillable =['name', 'city', 'address', 'subtotal', 'code_id', 'user_id'];


    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
