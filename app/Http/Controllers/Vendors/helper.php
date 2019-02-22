<?php

function status($key)
{
    return ($key == \App\User::ON)? 'مستخدم مفعل' :  'مستخدم موقوف';
}
function role($key)
{
    return ($key == \App\User::ADMIN_USER)? '  مدير موقع' :  'مستخدم عادى';
}
