<?php

namespace App\Http\Controllers\Api\Order;

use App\CutterKind;
use App\CutterSize;
use App\Http\Controllers\ApiController;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    private $data;
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
    public function show(Request $request,Order $order)
    {
        $this->data['order'] = $order;
        if ($request->locale == 'ar')
        {
            $this->data['product'] = Product::select('id','name_ar as name','description_ar as description','photo1','photo2','price','quantity','category_id')->where('id',$order->product_id)->get();
        }
        else{
            $this->data['product'] = Product::select('id','name_en as name','description_en as description','photo1','photo2','price','quantity','category_id')->where('id',$order->product_id)->get();
        }
        if ($request->locale == 'ar')
        {
            $this->data['cuttersize'] = CutterSize::select('id','name_ar as name','description_ar as description')->where('id',$order->cuttersize_id)->get();
        }
        else{
            $this->data['cuttersize'] = CutterSize::select('id','name_en as name','description_en as description')->where('id',$order->cuttersize_id)->get();
        }

        if ($request->locale == 'ar')
        {
            $this->data['cutterkind'] = CutterKind::select('id','name_ar as name','description_ar as description')->where('id',$order->cutterkind_id)->get();
        }
        else{
            $this->data['cutterkind'] = CutterKind::select('id','name_en as name','description_en as description')->where('id',$order->cutterkind_id)->get();
        }
//        dd($this->data);
        return response()->json($this->data,200);
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
