@extends('layouts.app')

@section('page-title')
    <h1 class="page-title"> لوحة التحكم
        <small> تعديل اعدادت الموقع </small>
    </h1>
@endsection

@section('content')


    {{--
            `name`, `email`, `phone`, `password`, `api_token`, `role`, `status`, `city`, `address`, `verify`
    --}}
    <div class="row">
        <div class="col-md-6" style="margin-right: 200px">

            <div class="portlet-body">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> تقرير عن كمية المبيعات خلال السنة  </span>
                </div>
                <div id="chart_1" class="chart" style="height: 500px;"> </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
