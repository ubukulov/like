<?php
### Администраторская часть ###
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    # маршруты начинается со слова админ
    Route::get('/', 'AuthController@showLogin');
    Route::get('/login', 'AuthController@showLogin');
    Route::post('/login', 'AuthController@authenticate');
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'IndexController@index']);
    Route::get('/logout', 'AuthController@logout');
    
    # Привелегии для администратора
    Route::group(['middleware' => 'manager:4'], function(){
        # Марщруты для "задания"
        Route::get('/certs', 'CertController@index');
        Route::get('/cert/new', 'CertController@create');
        Route::post('/cert/store', 'CertController@store');
        Route::get('/cert/{id}', 'CertController@edit');
        Route::post('/cert/{id}', 'CertController@update');
        Route::get('/cert/delete/{id}', 'CertController@destroy');
        # Маршруты для "карты"
        Route::get('/cards', 'CardController@index'); // Список всех карт
        Route::get('/cards_vip', 'CardController@vip'); // Список вип карт
        # Маршруты для "партнеры"
        Route::get('/partners', 'PartnerController@index'); // Список партнеров
        Route::get('/partner/create', 'PartnerController@create'); // форма добавление партнера
        Route::post('/partner/store', 'PartnerController@store'); // сохранение партнера
        Route::get('/partner/delete/{id}', 'PartnerController@destroy'); // удаление по ид
        Route::get('/partner/{id}', 'PartnerController@edit'); // форма редактирование партнера
        Route::post('/partner/update/{id}', 'PartnerController@update'); // обновление информации о партнера
        Route::get('/partners/charge', 'PartnerController@partner_charges'); // начисление партнеров
        Route::get('/partner/charge/refund/{id}', 'PartnerController@refund'); // возврат
        # Маршруты для "пользователи"
        Route::get('/users', 'UserController@index'); // Список пользователей
        Route::post('/users/phone', 'UserController@phone'); // поиск по телефон номеру
        Route::get('/users/card/{number}', 'UserController@card'); // поиск по номер карту
        # OptPrice
        Route::get('/opt_price', 'OptpriceController@index'); // список прайсов
        Route::get('/opt_partner', 'OptpriceController@partner'); // список партнеров
        Route::get('/opt_cat', 'OptpriceController@cat'); // список категории
        Route::get('/opt_partner/new', 'OptpriceController@partner_create'); // форма добавление партнера
        Route::post('/opt_partner/store', 'OptpriceController@partner_store'); // сохранение информации
        Route::get('/opt_partner/{id}', 'OptpriceController@partner_edit'); // посмотреть информации по ид партнера
        Route::post('/opt_partner/{id}', 'OptpriceController@partner_update'); // обновить информацию по ид партнера
        Route::get('/opt_partner/delete/{id}', 'OptpriceController@partner_destroy'); // удаление по ид партнера
        Route::get('/opt_price/delete/{id}', 'OptpriceController@destroy'); // удаление основного прайса
        Route::get('/opt_price/new', 'OptpriceController@create'); // форма добавление основного прайса
        Route::post('/opt_price/store', 'OptpriceController@store'); // сохранение
        Route::get('/opt_price/{id}', 'OptpriceController@edit'); // форма редактирование основного прайса
        # Ассортименты
        Route::get('/range', 'OptpriceController@range_index'); // список ассортиментов по опт прайсу
        Route::get('/range/new', 'OptpriceController@range_create'); // форма добавление ассортимента
        Route::post('/range/store', 'OptpriceController@range_store'); // сохранение ассортимента
        Route::get('/range/delete/{id}', 'OptpriceController@range_destroy'); // удаление ассортимента по ид
        Route::get('/range/{id}', 'OptpriceController@range_edit'); // форма редактирование
        Route::post('/range/{id}', 'OptpriceController@range_update'); // обновление по ид
        Route::get('/range/img/delete/{id}', 'OptpriceController@range_destroy_photo'); // удаление картинку
        # Страницы
        Route::get('/pages', 'PageController@index'); // список страницы
        Route::get('/page/new', 'PageController@create'); // форма добавление
        Route::post('/page/store', 'PageController@store'); // сохранение
        Route::get('/page/delete/{id}', 'PageController@destroy'); // удаление
        Route::get('/page/{id}', 'PageController@edit'); // редактирование
        Route::post('/page/{id}', 'PageController@update'); // обновление
        # Task
        Route::get('/tasks', 'TaskController@index'); // список задание по проекту Task
        Route::get('/task/works', 'TaskController@works'); // список работы
        Route::get('/task/types', 'TaskController@types'); // типы задании
        Route::get('/task/type_create', 'TaskController@type_create'); // форма добавление тип задании
        Route::post('/task/type_store', 'TaskController@type_store'); // сохранение тип задании
        Route::get('/task/type/{id}', 'TaskController@type_edit'); // форма редактирование
        Route::post('/task/type_update/{id}', 'TaskController@type_update'); // форма обновление
        Route::get('/task/type/delete/{id}', 'TaskController@type_destroy'); // удаление тип
        Route::get('/task/{id}', 'TaskController@edit'); // форма редактирование задании
        Route::get('/task/delete/{id}', 'TaskController@destroy'); // удаление таск по ид
    });

    # Привилегии для менеджера
    Route::group(['middleware' => 'manager:2'], function(){
        # Марщруты для "задания"
        Route::get('/certs', 'CertController@index');
        Route::get('/cert/new', 'CertController@create');
        Route::post('/cert/store', 'CertController@store');
        Route::get('/cert/{id}', 'CertController@edit');
        Route::post('/cert/{id}', 'CertController@update');
    });

});
### Конец административная часть ###