<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private  $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::select('*');
        foreach (array_except($request->all(),'page') as $key=>$value)
        {
            if ($key == '')
                continue;
            if ($key == 'name_ar')
                $products->where($key, 'like','%'.$value.'%');
            if ($key == 'name_en')
                $products->where($key,'like','%'.$value.'%');
            $products->where($key,'=',$value);

            $products->paginate(50);
            return view('products.index',compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->objectToArray(Category::all());
        return view('categories.index',$categories);
    }

    public function objectToArray($object)
    {
        $data = [];
        foreach ($object as $value)
        {
            $data[$value->id] = $value->name_ar;
        }
        return $data;
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
            'price' => 'required|numeric',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'quantity' => 'required|numeric',
            'category_id' => 'required|numeric',
        ];
        $this->validate($request,$rules);

        $product = Product::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo' =>   $request->photo->store(''),
            'price' =>   $request->price,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        return view('products.store');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules  = [
            'name_ar' => 'required|string|max:190',
            'name_en' => 'required|string|max:190',
            'photo' => 'required|image',
            'price' => 'required|numeric',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'quantity' => 'required|numeric',
            'category_id' => 'required|numeric',
        ];
        $this->validate($request,$rules);

        $product = Product::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo' =>   $request->photo->store(''),
            'price' =>   $request->price,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
