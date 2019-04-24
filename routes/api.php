<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>['api']],function (){


    // Auth
    Route::post('login', 'Auth\LoginController@login');

    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('/users/store','Api\User\UserController@store');
    Route::get('/target','Api\HomeController@targetCity');
    Route::get('/settings',"Api\Setting\SettingController@index");

    // start Email routes

    Route::post('/password/email','Api\User\UserController@send');


    Route::post('/message','Api\Contact\ContactController@send');
    // end Email routes



    //start branch routes
    Route::resource('/branch','Api\Branch\BranchController')->only(['index']);
    Route::resource('/branch.products','Api\Branch\BranchProductController')->only(['index']);
    //end  branch routes


    //start categories routes
    Route::resource('/categories','Api\Category\CategoryController')->only(['index','show']);
    Route::resource('/categories.products','Api\Category\CategoryProductController')->only(['index']);
    Route::get('/cutter/size','Api\Cutter\CutterController@size');
    Route::get('/cutter/kind','Api\Cutter\CutterController@kind');
    //End categories routes


    //start product routes
    Route::resource('/products','Api\Product\ProductController')->only(['index','show']);
    Route::resource('/product.branches','Api\Product\ProductBranchController')->only(['index']);
    //end  product routes


    Route::group(['middleware'=>'auth:api'],function (){
    //start users routes

        Route::get('/users/requests','Api\User\UserRequestController@index');
        Route::get('/users/orders','Api\User\UserOrderController@index');
        Route::get('/user/show','Api\User\UserController@show');

        Route::put("/user/update",'Api\User\UserController@update');
        Route::resource('/users','Api\User\UserController')->except(['edit','create']);
        Route::resource('/users.requests','Api\User\UserRequestController')->only(['index']);
        Route::get('/users/requests','Api\User\UserRequestController@index');
        Route::resource('/users.orders','Api\User\UserOrderController')->only(['index']);



        //End users routes







    //start requests routes
    Route::post('/orders/request','Api\Request\RequestController@request');
    Route::resource('/requests','Api\Request\RequestController')->only(['index','show','store']);
    Route::resource('/requests.orders','Api\Request\RequestOrderController')->only(['index']);
    //end  requests routes


    //start orders routes
    Route::resource('/orders','Api\Order\OrderController')->only(['index','show','store']);
    //end  orders routes



        Route::put('/password/reset','Api\User\UserController@updatePassword');




    });





});

/*
 * حذف ال user id
 * orders * products * categories  Ar - En
 * pagination Orders
 *
 */
