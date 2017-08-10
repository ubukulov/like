@extends('admin/layout/default')
@section('content')
<section class="content-header">
    <h1>
        Форма добавление партнера
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/partner/store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Наименование</label>
                            <input type="text" class="form-control" id="name" required="required" name="name" placeholder="Введите название">
                        </div>

                        <div class="form-group">
                            <label for="name_sms">Название для смс на латинице</label>
                            <input type="text" class="form-control" id="name_sms" required="required" name="name_sms" placeholder="Название для смс на латинице">
                        </div>

                        <div class="form-group">
                            <label for="phone">Телефоны</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефоны">
                        </div>

                        <div class="form-group">
                            <label for="mphone">Телефоны для смс</label>
                            <input type="text" class="form-control" id="mphone" name="mphone" placeholder="Телефоны для смс">
                        </div>

                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Введите адрес партнера">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Введите email"/>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="hours">Режим работы</label>
                            <input type="text" class="form-control" id="hours" name="hours" placeholder="Введите режим работы" />
                        </div>

                        <div class="form-group">
                            <label for="referral">Реферал(Ид пользователя)</label>
                            <input type="text" class="form-control" id="referral" name="referral" placeholder="Введите ид реферала" />
                        </div>

                        <div class="form-group">
                            <label for="username">Логин</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Введите логин" />
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Введите пароль" />
                        </div>

                        <div class="form-group">
                            <label for="max_sum">Максимальная сумма</label>
                            <input type="text" class="form-control" id="max_sum" name="max_sum" placeholder="Максимальная сумма без подтверждения смс" />
                        </div>

                        <div class="form-group">
                            <label for="percent_proizvol_sum">Процент произвольной суммы</label>
                            <input type="text" class="form-control" id="percent_proizvol_sum" name="percent_proizvol_sum" placeholder="Процент произвольной суммы" />
                        </div>

                        <div class="form-group">
                            <label for="type">Статус партнера</label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">
                                    недоверительный партнер
                                </option>
                                <option value="1">
                                    доверительный партнер
                                </option>
                            </select>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div id="image1">
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать картинку</button>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <input id="coords" name="coords"  type="hidden" value=""/>
                                <div id="map" style="width: 770px; height: 454px; margin-bottom: 20px "></div>
                            </div>
                        </div>

                        <br><br>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Сохранить партнера</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </form>
</section>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;
    function init() {
        myMap = new ymaps.Map("map", {
            center: [43.2725, 76.9099], // Углич
            zoom: 12
        }, {
            balloonMaxWidth: 200
        });
        // В метод add можно передать строковый идентификатор
        // элемента управления и его параметры.
        myMap.controls
        // Кнопка изменения масштаба.
        .add('zoomControl', {left: 5, top: 5})
        // Обработка события, возникающего при щелчке
        // левой кнопкой мыши в любой точке карты.
        // При возникновении такого события откроем балун.
        myMap.events.add('click', function (e) {
            if (!myMap.balloon.isOpen()) {
                var coords = e.get('coordPosition');
                myMap.balloon.open(coords, {
                        contentHeader: 'Новая метка!'
                    }
                );
                $('#coords').val([
                    coords[0].toPrecision(6),
                    coords[1].toPrecision(6)
                ].join(', '))
            } else {
                myMap.balloon.close();
            }
        });
        // Обработка события, возникающего при щелчке
        // правой кнопки мыши в любой точке карты.
        // При возникновении такого события покажем всплывающую подсказку
        // в точке щелчка.
        myMap.events.add('contextmenu', function (e) {
            myMap.hint.show(e.get('coordPosition'), 'Кто-то щелкнул правой кнопкой');
        });
    }
</script>
@stop