<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const NEW = 'new';
    const PROCESSING = 'processing';
    const DELIVERED = 'delivered';
    //
}
