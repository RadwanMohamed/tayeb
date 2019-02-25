@extends('layouts.app')

@section('page-title')
    <h1 class="page-title"> لوحة التحكم
        <small>عرض جميع الاعضاء</small>
    </h1>
@endsection

@section('content')


    {{--
            `name`, `email`, `phone`, `password`, `api_token`, `role`, `status`, `city`, `address`, `verify`
    --}}
    <div class="row">
        <div class="col-md-6" style="margin-right: 200px">
            @if(\Session::has('status'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('status') !!}</li>
                    </ul>
                </div>
            @endif
            <form role="form" action="{{route('branches.update',$branch->id)}}" method="post">
                @csrf
                @method('put')
                <div class="form-body">

                    <div class="form-group">
                        <label>اسم الفرع</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-pencil"></i>
                            </span>
                            <input type="text" name="name" class="form-control" value="{{$branch->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>مدينة الفرع</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-pencil"></i>
                            </span>
                            <input type="text" name="city" class="form-control"value="{{$branch->city}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>وصف</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-pencil"></i>
                            </span>
                            <textarea type="text" name="description" class="form-control">{{$branch->description}}</textarea>
                        </div>
                    </div>


                    <div class="form-actions">
                        <button type="submit" class="btn blue">حفظ</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
