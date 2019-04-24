<?php

namespace App\Traits;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

 /**
  * displys the json response message
  *
*/
trait ApiResponser
{
    private function successResponse($data,$code)
    {
        return response()->json($data,$code);
    }
    protected  function errorResponse($message,$code)
    {
        return response()->json(['error'=>$message,'code'=>$code],$code);
    }

    protected function showAll($key,Collection $collection , $code =200)
    {
        return $this->successResponse(["$key"=>$collection],$code);
    }
    protected function showOne($key,Model $model , $code =200)
    {
        return $this->successResponse(["$key"=>$model],$code);
    }
    protected function showMessage($message , $code =200)
    {
        return $this->successResponse(['data'=>$message],$code);
    }
    public function paginate(Collection $collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perpage = 15;
        $results = $collection->slice(($page - 1)*$perpage,$perpage)->values();
        $paginated = new LengthAwarePaginator($results,$collection->count(),$perpage,$page,[
           'path'=> LengthAwarePaginator::resolveCurrentPath(),
        ]);
        $paginated->appends(request()->all());
        return $paginated;
    }
}
