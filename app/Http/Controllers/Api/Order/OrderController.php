<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\ApiController;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return $this->showAll('orders',$orders);
    }


    /**
     * display specific resource
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        return $this->showOne('order',$order);
    }

    /**
     * display specific resource
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $rules  = [
            'name'       => 'required|string|max:190',
            'cutter_kind'       => 'required|string|max:190',
            'size'    => 'required|numeric',
            'price'       => 'required|numeric',
            'quantity'    => 'required|numeric',
            'subtotal'   => 'required|numeric',
            'request_id'    => 'required|numeric',
        ];
        $this->validate($request,$rules);

        $order = Order::create([
            'name'              => $request->name,
            'cutter_kind'       => $request->cutter_kind,
            'size'              => $request->size,
            'price'             => $request->price,
            'quantity'          => $request->quantity,
            'status'            => Order::NEW,
            'subtotal'          => $request->subtotal,
            'request_id'        => $request->request_id,
        ]);
        return $this->showOne('order',$order,201);
    }


}
