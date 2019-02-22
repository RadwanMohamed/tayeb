<?php

namespace App\Http\Controllers\Api\Request;

use App\Http\Controllers\ApiController;
use App\Request;

class RequestOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $request->orders;
        return $this->showAll('orders',$orders);
    }


}
