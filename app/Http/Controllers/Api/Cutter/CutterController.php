<?php

namespace App\Http\Controllers\Api\Cutter;

use App\CutterKind;
use App\CutterSize;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CutterController extends ApiController
{
    public function size(Request $request)
    {
        if ($request->locale == 'ar')
        {
            $size = CutterSize::select('id','name_ar as name','description_ar as description')->get();
        }
        else{
            $size = CutterSize::select('id','name_en as name','description_en as description')->get();
        }

        return $this->showAll('cutter_size',$size);
    }
    public function kind(Request $request)
    {
        if ($request->locale == 'ar')
        {
            $kind = CutterKind::select('id','name_ar as name','description_ar as description')->get();
        }
        else{
            $kind = CutterKind::select('id','name_en as name','description_en as description')->get();
        }
        return $this->showAll('cutter_kind',$kind);
    }
}
