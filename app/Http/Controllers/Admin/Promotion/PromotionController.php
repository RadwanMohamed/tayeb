<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $codes = Promotion::all();
        return view('promotions.index',compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotion.create');
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
            'name' => 'required|string|max:190',
            'code' => 'required|string',
            'count' => 'required|numeric',
            'status' => 'required|string',
            'type' => 'required|string',
            'value' => 'required|numeric',
        ];
        $this->validate($request,$rules);

        $code = Promotion::create([
            'name'=>$request->name,
            'code'=>$request->code,
            'count'=>$request->count,
            'status'=>$request->status,
            'type'=>$request->type,
            'value'=>$request->value,
        ]);

        return view("codes.index")->with("status",'تمت اضافة الكود بنجاح');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $code)
    {
        $code->delete();
    }

}
