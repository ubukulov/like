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
        # Task
        Route::get('/task', 'TaskController@index'); // список задании
        Route::get('/task/commits/{id}', 'TaskController@commits'); // 
        Route::post('/task/send_commit/{id_work}', 'TaskController@send_commit');
        
        # баланс
        Route::get('/balance/history', 'IndexController@balance_history');

        # вывод средство
        Route::get('/balance/withdraw', 'IndexController@withdraw'); // снят со счета
    });

});
### Конец пользовательская часть ###
