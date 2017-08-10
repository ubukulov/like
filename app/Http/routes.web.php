<?php
### Общее ###
Route::get('/', ['as' => 'home', 'uses' => 'IndexController@welcome']); // Главная страница
Route::get('/cashback', 'IndexController@cashback'); // Сервис кэшбэк
Route::get('/store', ['middleware' => 'auth','as' => 'store', 'uses' => 'StoreController@index']); // Список магазинов
Route::get('/admitad/offer/{id}', 'StoreController@coupon'); // Список промокодов выбранного оффера

# OptPrice
Route::get('/optprice', 'OptpriceController@index'); // список партнеров или товар и услуг
Route::get('/optprice/{id}', 'OptpriceController@show');
Route::post('/location', 'IndexController@setLocation');
# Cert
Route::get('/cert/{id}', 'IndexController@cert');/*->middleware('crt');*/ // Отделная страница для офлайн задания
Route::get('/cert/cat/{id}', 'IndexController@cert_cat');
# Task
Route::get('/task', ['as' => 'task', 'uses' => 'TaskController@index']); // список задании
Route::get('/task/{id}', 'TaskController@show');/*->middleware('crt');*/
Route::post('/task/done', 'TaskController@store');
Route::get('/task/filter/top_users', 'TaskController@top_users'); // топ испольнителей
Route::get('/task/filter/types', 'TaskController@types'); // топ испольнителей
Route::get('/task/filter/partners', 'TaskController@partners'); // топ испольнителей
Route::get('/task/filter/types/{id}', 'TaskController@types_tasks');
Route::get('/task/filter/partners/{id}', 'TaskController@partners_tasks');
Route::get('/task/filter/high_price', 'TaskController@high_payment');
### Конец ###