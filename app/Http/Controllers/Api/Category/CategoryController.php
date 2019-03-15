<?php

namespace App\Http\Controllers\Api\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\App;


class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        App::setLocale($locale);
        $categories = Category::all();
        return $this->showAll('categories',$categories);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale,Category $category)
    {
        App::setLocale($locale);
        return $this->showOne('category',$category);
    }


}
