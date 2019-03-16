<?php

namespace App\Http\Controllers\Api\Request;

use App\Http\Controllers\ApiController;
use App\Order;
use App\Promotion;
use App\User;
use Illuminate\Http\Request;


class RequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = \App\Request::all();
        return $this->showAll('requests',$requests);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Request $request)
    {
        return $this->showOne('request',$request);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $rules  = [
            'name'       => 'nullable|string|max:190',
            'address'    => 'required|string',
            'city'       => 'required|string',
            'subtotal'   => 'required|numeric',
            'user_id'    => 'required|numeric',
            'code_id'    => 'nullable|numeric',
        ];
        $this->validate($request,$rules);
        $req = \App\Request::create([
            'name'       => $request->name,
            'address'    => $request->address,
            'city'       => $request->city,
            'subtotal'   => $request->subtotal,
            'user_id'    => $request->user_id,
            'code_id'    => $request->code_id,
        ]);
        return $this->showOne('request',$req,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function request(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        if (!$request->has('orders'))
                return $this->errorResponse('you must to choose at least one product',422);

        $rules  = [
            'name'       => 'nullable|string|max:190',
            'address'    => 'required|string',
            'city'       => 'required|string',
        ];
        $this->validate($request,$rules);


        $req = new \App\Request();



        $req->name = $request->name;
        $req->city = $request->city;
        $req->address = $request->address;
        $req->user_id = $user->id;
        $req->subtotal = 0;
        $req->status  = \App\Request::NEW;
        $req->save();
        $arr = json_decode($request->orders);
        $sub = 0;
        foreach ($arr as $order)
        {

           $order = Order::create([
                'name' => $order->name,
                'cutter_kind' => $order->cutter_kind,
                'size' => $order->size,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'status' => Order::NEW,
                'subtotal' => $order->quantity * $order->price,
                'request_id' => $req->id,
            ]);
           $sub +=$order->subtotal;
        }

        if ($request->has('code'))
        {
            $code = Promotion::where('code' , '=', $request->code)->first();
            if($code != [] && $code->status != Promotion::EXPIRED )
            {
                $req->code_id = $code->id;
                $req->subtotal = ($code->type == Promotion::FIXED)? ($sub - $code->value) : $sub-($sub * $code->value/100);
                $code->count -=1;
                $code->save();


            }
            else{
                return $this->errorResponse('please enter a valid code',404);
            }


        }else
        {
            $req->subtotal = $sub;
        }
        $req->save();
        return $this->showOne('request',$req);
    }



}
