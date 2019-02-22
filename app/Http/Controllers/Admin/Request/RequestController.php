<?php

namespace App\Http\Controllers\Admin\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requests = \App\Request::select('*');
        foreach (array_except($request->all(),'page') as $key => $value)
        {
            if ($key == '')
                continue;
            if ($key == 'name')
                $requests = $requests->where($key,'like','%'.$value.'%');
            $requests = $requests->where($key,'=',$value);
        }
        $requests->paginate(50);
        return view('requests.index',compact('requests'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Request $request)
    {
        return view("requests.show",compact('request'));
    }

}
