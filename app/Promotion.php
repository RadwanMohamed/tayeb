<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    const EXPIRED = 'expired';
    const ACTIVATED = 'activated';
    const FIXED = 'fixed';
    const DYNAMIC = 'dynamic';


    public static  function generatePromoCode()
    {
        return str_random(6);
    }
}
