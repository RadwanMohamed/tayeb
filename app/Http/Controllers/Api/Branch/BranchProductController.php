<?php

namespace App\Http\Controllers\Api\Branch;

use App\Branch;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\App;

class BranchProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Branch $branch)
    {
//        $category = Category::find($request->category_id);
        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }
        if ($request->locale == 'ar')
        {
            $products = $branch->products()->select("product_id as id","name_ar as name","description_ar as description","photo1","photo2","price","quantity")->where('category_id',$request->category_id)->get();

        }else{
            $products = $branch->products()->select("product_id as id","name_en as name","description_en as description","photo1","photo2","price","quantity")->where('category_id',$request->category_id)->get();

        }
        $products = $this->paginate($products);
//        dd($products);
        return response()->json($products,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
