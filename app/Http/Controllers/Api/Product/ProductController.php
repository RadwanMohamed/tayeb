<?php

namespace App\Http\Controllers\Api\Product;

use App\Product;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locale = $request->locale;
        App::setLocale($locale);
        if ($request->locale == 'ar')
        {
            $products = Product::select('id','name_ar as name','description_ar as description','photo1','photo2','price','quantity','category_id');
        }
        else{
            $products = Product::select('id','name_en as name','description_en as description','photo1','photo2','price','quantity','category_id');
        }
        $products = $products->paginate(20);
        return response()->json($products);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale,Product $product)
    {
        App::setLocale($locale);
        return $this->showOne('product',$product);
    }


}
