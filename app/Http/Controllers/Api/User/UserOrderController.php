<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;

class UserOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user)
    {
        $orders = $user->requests()->with('orders')->get()->pluck('orders');
        return $this->showAll('orders',$orders);
    }


}
