<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;

class UserRequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $requests = $user->requests;
        $this->showAll('requests',$requests);
    }


}
