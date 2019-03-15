<?php

namespace App\Http\Controllers\Api\Product;

use App\Product;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        App::setLocale($locale);
        $products = Product::paginate(20);
        return $this->showAll('products',$products);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale,Product $product)
    {
        App::setLocale($locale);
        return $this->showOne('product',$product);
    }


}
