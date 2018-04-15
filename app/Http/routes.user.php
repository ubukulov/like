<?php

### Пользовательская часть ###
Route::group(['namespace' => 'Usr', 'prefix' => 'user'], function(){
    Route::get('/login', ['as' => 'showLoginUser', 'uses' => 'AuthController@showLogin']);
    Route::post('/login', 'AuthController@authenticate');
    Route::get('/password/reset', 'AuthController@showResetForm'); // форма сброса пароля
    Route::post('/password/reset', 'AuthController@reset'); // сброс пароля
    Route::get('/register', 'AuthController@showRegisterForm'); // форма регистрации нового пользователя
    Route::post('/register', 'AuthController@register'); // регистрация пользователя
    # Маршруты доступно только после авторизации
    Route::group(['middleware' => ['auth']], function(){
        Route::get('/account', 'IndexController@account');
        Route::get('/logout', 'IndexController@logout');
        Route::get('/setting', 'IndexController@setting_form');
        Route::post('/setting', 'IndexController@setting_save');
        Route::post('/account/bank', 'IndexController@bank');
        # Task
        Route::get('/task', 'TaskController@index'); // список задании
        Route::get('/task/commits/{id}', 'TaskController@commits'); // 
        Route::post('/task/send_commit/{id_work}', 'TaskController@send_commit');
        
        # баланс
        Route::get('/balance/history', 'IndexController@balance_history');

        # вывод средство
        Route::post('/account/withdraw', 'IndexController@withdraw'); // снят со счета

        # тариф Бизнес
        Route::get('/business', 'IndexController@business'); // страница для бизнес тарифа
        Route::post('/business/set', 'IndexController@business_set');
        Route::get('/business/statistics', 'IndexController@statistics');
        Route::get('/business/offline', 'IndexController@offline');
        Route::post('/business/offline', 'IndexController@setOfflineOrder');
        Route::post('/business/set_offline_order', 'IndexController@set_offline_order');
    });

});
### Конец пользовательская часть ###
