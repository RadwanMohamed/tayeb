<?php

namespace App\Http\Controllers\Api\Request;

use App\Http\Controllers\ApiController;
use App\Order;
use App\Product;
use App\Promotion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class RequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = \App\Request::with('orders')->get();
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

        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }

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

        if (!$request->has("orders"))
            return response()->json(["error"=>"يجب ان يحتوى على طلب واحد على الاقل "],422);
        $sub = 0;
        foreach ($request->orders as $order)
        {
            $product = Product::where('id','=',$order['product_id'])->first();

            if (!$product)
                    return response()->json(['error'=>"you must choose a valid product"],200);

            $order = Order::create([
                'name' => $product->name_en,
                'cuttersize_id' => $order['cuttersize_id'],
                'cutterkind_id' => $order['cutterkind_id'],
                'price' => $product->price,
                'quantity' => $order['quantity'],
                'status' => Order::NEW,
                'product_id' => $order['product_id'],
                'subtotal' => $order['quantity'] * $product->price,
                'request_id' => $req->id,
            ]);

            $sub +=$order->subtotal;

        }
        if (!$request->has('code') || $request->code == null || $request->code == "")
        {
            $req->subtotal = $sub;
        }
        else
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


        }

        $req->save();
        return $this->showOne('request',$req);
    }



}
