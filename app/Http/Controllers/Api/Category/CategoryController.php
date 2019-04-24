<?php

namespace App\Http\Controllers\Api\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }
        if ($request->locale == 'ar')
        {
            $categories = Category::select('id','name_ar as name','description_ar as description','photo')->get();
        }
        else{
            $categories = Category::select('id','name_en as name','description_en as description','photo')->get();
        }


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
