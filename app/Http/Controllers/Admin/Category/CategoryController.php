<?php

namespace App\Http\Controllers\Admin\Category;
use File;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.index');
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
            'name_ar' => 'required|string|max:190',
            'name_en' => 'required|string|max:190',
            'photo' => 'required|image',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ];
        $this->validate($request,$rules);

        $category = Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo'  =>  $request->photo->store(''),
            'description_ar' => $request->name_ar,
            'description_ar' => $request->name_en,
        ]);

        return redirect(route('categories.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.edit",compact('category'));
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
        $rules  = [
            'name_ar' => 'required|string|max:190',
            'name_en' => 'required|string|max:190',
            'photo' => 'required|image',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ];
        $this->validate($request,$rules);

        $category = Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo'  =>  $request->photo->store(''),
            'description_ar' => $request->name_ar,
            'description_ar' => $request->name_en,
        ]);

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(is_file($category->photo))
            File::delete($category->photo);
        $category->delete();
        return redirect(route('categories.index'));
    }
}
