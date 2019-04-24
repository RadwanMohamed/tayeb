<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;


class UserOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        $orders = $user->requests()->with('orders')->get()->pluck('orders');
        return $this->showAll('orders',$orders);
    }


}
