<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;

class UserRequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        $requests = $this->paginate($user->requests);
       return response()->json($requests,200);
    }



}
