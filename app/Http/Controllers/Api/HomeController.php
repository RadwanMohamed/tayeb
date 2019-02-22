<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Http\Controllers\ApiController;

class HomeController extends ApiController
{
    /**
     * find city target
     * @param $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function targetCity($city)
    {
        $branches = Branch::where('city','LIKE','%'.$city.'%');
        if ($branches->count()<1)
            return $this->errorResponse('we are sorry! our services dont cover this city',404);
        else
            return $this->showAll('branches',$branches->get());
    }
}
