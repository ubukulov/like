<?php
Route::group(['namespace' => 'Partner', 'prefix' => 'partner'], function(){
    Route::get('/', ['as' => 'showLogin', 'uses' => 'AuthController@showLogin'])->middleware('prt'); // форма авторизации
    Route::post('/login', 'AuthController@authenticate'); // процесс аутентификации
    # доступно после авторизации
    Route::group(['middleware' => ['prt_not']], function(){
        Route::get('/account', 'IndexController@index'); // личный кабинет партнера
        Route::get('/logout', 'AuthController@logout'); // выйти из личного кабинета
        # task
        Route::get('/task', 'TaskController@index'); // список задании
        Route::get('/task/create', 'TaskController@create'); // форма добавление задании
        Route::post('/task/store', 'TaskController@store'); // сохранение
        Route::get('/task/works', 'TaskController@works'); // список работы
        Route::get('/work/{id}', 'TaskController@approve'); // по нажатию кнопку одобрить получаем необходимые данные
        Route::get('/task/rating/{rid}/work/{id}', 'TaskController@rating'); // оценка испольнителей
        Route::get('/task/send/{id_detail}/{id_task}/{id_work}', 'TaskController@send_money'); // вознаграждение денгами
        Route::get('/task/sendgift/{id_detail}/{id_work}', 'TaskController@send_gift'); // вознаграждение подарками
        Route::get('/task/work/close/{id_work}', 'TaskController@task_work_close');
        Route::post('/task/work/commit', 'TaskController@task_work_commit');
        Route::get('/task/commits/{id}', 'TaskController@commits'); //
        Route::post('/task/send_commit/{id_work}', 'TaskController@send_commit');
        # история счета партнера
        Route::get('/balance/history', 'IndexController@balance_history');
        # история отправленные подарки
        Route::get('/task/gifts', 'TaskController@gifts'); // список отправленные подарки
        # Начисление процент испольнителю
        Route::get('/transfer_percent', 'TransferController@index'); // шаблон для страницу начисление процента
        Route::get('/transfer_percent/{card}', 'TransferController@card'); // поиск владелца по номер карту
        Route::post('/transfer_percent/user', 'TransferController@transfer_percent'); // начисляем процент пользователю
        # пополнение счета
        Route::get('/payment', 'TransferController@payment'); // форма пополнение счета
        Route::post('/paybox/payment', 'TransferController@replenish'); // оплата
    });
});