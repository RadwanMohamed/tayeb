<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable =['name', 'cutter_kind', 'size', 'price', 'quantity', 'status', 'subtotal', 'request_id'];
    const NEW = 'new';
    const PROCESSING = 'processing';
    const DELIVERED = 'delivered';

}
