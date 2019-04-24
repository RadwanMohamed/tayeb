<?php

function status($key)
{
    return ($key == \App\User::ON)? 'مستخدم مفعل' :  'مستخدم موقوف';
}
function role($key)
{
    return ($key == \App\User::ADMIN_USER)? '  مدير موقع' :  'مستخدم عادى';
}
function codeStatus($key)
{
    return ($key == \App\Promotion::ACTIVATED)? 'مفعل' :  'منتهى';
}

function orderStatus($key)
{
    if ($key ==  \App\Order::NEW)
        return 'جديد';
    elseif ($key == \App\Order::PROCESSING)
        return 'جارى التحضير';
    else
        return ' منتهي ';
}
function requestStatus($id)
{
   $orders = \App\Order::where('request_id',$id)->get();
   foreach ($orders as $order)
    {
        if ($order->status != \App\Order::DELIVERED)
            return 'جديد';

    }
    return "منتهي";

}

function monthName($key)
{
    $monthes = [
      1 => 'يناير',
      2 => 'فبراير',
      3 => 'مارس',
      4 => 'ابريل',
      5 => 'مايو',
      6 => 'يونيو',
      7 => 'يوليو',
      8 => 'اغسطس',
      9 => 'سبتمبر',
      10 => 'اكتوبر',
      11 => 'نوفمبر',
      12 => 'ديسمبر',
    ];
    return $monthes[$key];
}
