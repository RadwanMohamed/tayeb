<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable =['name', 'cutterkind_id', 'cuttersize_id', 'price', 'quantity', 'status', 'subtotal', 'request_id','product_id'];
    const NEW = 'new';
    const PROCESSING = 'processing';
    const DELIVERED = 'delivered';
    public function product()
    {
        return $this->hasOne("App\Product");
    }

}
