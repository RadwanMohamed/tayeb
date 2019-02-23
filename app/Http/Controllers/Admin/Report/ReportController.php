<?php

namespace App\Http\Controllers\Admin\Report;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    private  $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders =  $this->ordersNumberperMonth(date('Y'));
       $req =  $this->incomePerMonth(date('Y'));
//dd($req);
//       dd($this->incomePerMonth(date('Y')));
       $this->data['orderpermonth'] = $orders;
        return view("reports.index",$this->data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get count of building per month by given year
     * @param $year
     * @return array
     */
    private function ordersNumberperMonth($year)
    {
        $ordersamount = [];
        $buar = [];

        $orderscount = Order::select('id','created_at')->whereRaw('year(`created_at`)=?',"$year")->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
        });
//        dd($orderscount);
        foreach ($orderscount as $key => $value)
        {
            $ordersamount[(int)$key] = count($value);
        }
        for ($i=1;$i<=12;$i++)
        {
            if(!empty($ordersamount[$i]))
                $buar[$i] = $ordersamount[$i];
            else
                $buar[$i] = 0;
        }

        return $buar;

    }
    private function incomePerMonth($year)
    {

    }



}
