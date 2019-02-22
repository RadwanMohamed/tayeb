<?php

Route::post('/adminpanel/users/{user}/block','Admin\User\UserController@block');
Route::post('/adminpanel/users/{user}/activate','Admin\User\UserController@activate');
Route::resource('/adminpanel/users','Admin\User\UserController');



Route::resource('/adminpanel/categories','Admin\Category\CategoryController');



Route::resource('/adminpanel/products','Admin\User\ProductController');



Route::resource('/adminpanel/orders','Admin\Order\OrderController');


Route::resource('/adminpanel/requests','Admin\Request\RequestController');



Route::resource('/adminpanel/promotions','Admin\Promotion\PromotionController');

