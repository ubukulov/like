<?php
use Illuminate\Support\Facades\DB;
use App\User;
### Общее ###
Route::group(['as' => 'subdomain', 'domain' => '{account}.likemoney.me'], function () {
    $url = $_SERVER["SERVER_NAME"];
    $domain = explode(".",$url);
    $sub_domain = $domain[0];
    $result = DB::table('business_store')->where(['store_name' => $sub_domain, 'status' => 1])->first();
    Route::get('/', ['as' => 'home', 'uses' => 'IndexController@welcome']); // Главная страница
    if($result){
//        Auth::loginUsingId($result->id_user, true);
        Route::get('/', 'IndexController@market');
    }else{
        return Redirect::to('http://likemoney.me');
    }
});

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

# Корзина
Route::get('/cart', 'CartController@index'); // корзина
Route::get('/cart/offer/{id}', 'CartController@add'); // добавление товара в корзину
Route::get('/cart/delete/{id}', 'CartController@delete'); // удаление товара из корзины
Route::get('/cart/count/{id}/{qty}', 'CartController@count'); // пересчитать корзину
Route::get('/cart/add/{id}', 'CartController@add_to_cart'); // положить товар в корзину
Route::post('/cart/order', 'CartController@order'); //
Route::get('/cart/checkout', 'CartController@checkout'); // оформление заказа
# новости
Route::get('/news', 'NewsController@index'); // список новостей
Route::get('/news/{id}', 'NewsController@show');

# магазин
Route::get('/item/{id}', 'StoreController@item')/*->middleware('store');*/;
Route::get('/cart/put/{id}', 'StoreController@add_to_cart'); // положить товар в корзину
Route::get('/store/count/{id}/{qty}', 'StoreController@count'); // пересчитать корзину
Route::post('/store/order', 'StoreController@order');
Route::get('/store/item/{id}', 'StoreController@add');
Route::post('/item/buy_one_click', 'StoreController@buy_one_click');
Route::get('/store/checkout/up/{item}', 'StoreController@op_tom');
Route::get('/store/checkout/down/{item}', 'StoreController@op_tom_down');
# партнерам
Route::get('/for-partner', 'IndexController@partner');

# страницы
Route::get("/page/{id}", 'PageController@get');

# интернет магазин по категорияем
Route::get("/cat/{id}", "IndexController@list_by_cat");
Route::get("/pod_cat/{id}", "IndexController@list_by_pod_cat");


# Предложить свой товар
Route::get('/suggest', 'IndexController@suggest');
Route::post('/suggest', 'IndexController@suggest_store');
### Конец ###