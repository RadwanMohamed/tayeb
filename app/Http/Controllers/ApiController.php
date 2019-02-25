<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    use ApiResponser;


//    public function forgetPassword(Request $request)
//    {
//        $user  = User::where('phone','=',$request->phone);
//        $user->verify = User::generateVerificationKey();
//        $user->save();
//
//        // phone
//        return $this->showMessage()
//    }
}
