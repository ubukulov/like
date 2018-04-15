@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Форма редактирование партнера
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/partner/update/'.$partner->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Наименование</label>
                                <input type="text" class="form-control" id="name" required="required" name="name" placeholder="Введите название" value="{{ $partner->name }}">
                            </div>

                            <div class="form-group">
                                <label for="name_sms">Название для смс на латинице</label>
                                <input type="text" class="form-control" id="name_sms" required="required" name="name_sms" placeholder="Название для смс на латинице" value="{{ $partner->name_sms }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Телефоны</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефоны" value="{{ $partner->phone }}">
                            </div>

                            <div class="form-group">
                                <label for="mphone">Телефоны для смс</label>
                                <input type="text" class="form-control" id="mphone" name="mphone" placeholder="Телефоны для смс" value="{{ $partner->mphone }}">
                            </div>

                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Введите адрес партнера" value="{{ $partner->address }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Введите email" value="{{ $partner->email }}"/>
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
                                <input type="text" class="form-control" id="hours" name="hours" placeholder="Введите режим работы"  value="{{ $partner->hours }}"/>
                            </div>

                            <div class="form-group">
                                <label for="referral">Реферал(Ид пользователя)</label>
                                <input type="text" class="form-control" id="referral" name="referral" placeholder="Введите ид реферала"  value="{{ $partner->referral }}"/>
                            </div>

                            <div class="form-group">
                                <label for="username">Логин</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Введите логин"  value="{{ $partner->username }}"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Введите пароль"  value="{{ $partner->password }}"/>
                            </div>

                            <div class="form-group">
                                <label for="max_sum">Максимальная сумма</label>
                                <input type="text" class="form-control" id="max_sum" name="max_sum" placeholder="Максимальная сумма без подтверждения смс" value="{{ $partner->max_sum }}" />
                            </div>

                            <div class="form-group">
                                <label for="percent_proizvol_sum">Процент произвольной суммы</label>
                                <input type="text" class="form-control" id="percent_proizvol_sum" name="percent_proizvol_sum" placeholder="Процент произвольной суммы" value="{{ $partner->percent_proizvol_sum }}" />
                            </div>

                            <div class="form-group">
                                <label for="type">Статус партнера</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="0" @if($partner->type == 0) selected="selected" @endif>недоверительный партнер</option>
                                    <option value="1" @if($partner->type == 1) selected="selected" @endif>доверительный партнер</option>
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
                                        @if(!empty($partner->image))
                                        <img src="{{ asset('uploads/partners/small/'.$partner->image) }}" height="100" name="image1">
                                        @else
                                        <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                                        @endif
                                    </div>
                                    <br>
                                    <button id="upload1" class="blue">Выбрать картинку</button>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="coords" name="coords"  type="hidden"  value="{{ $partner->coords }}"/>
                                    <div id="map" style="width: 770px; height: 454px; margin-bottom: 20px "></div>
                                </div>
                            </div>

                            <br><br>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Обновить информацию</button>
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
            @if(!empty($partner->coords))
            // Создаем метку с помощью вспомогательного класса.
            myPlacemark1 = new ymaps.Placemark([{{ $partner->coords }}], {
                // Свойства.
                // Содержимое иконки, балуна и хинта.
                iconContent: '',
                balloonContent: 'Старая метка',
                hintContent: 'Старая метка '
            }, {
                // Опции.
                // Стандартная фиолетовая иконка.
                preset: 'twirl#violetIcon'
            });
            // Добавляем все метки на карту.
            myMap.geoObjects
            .add(myPlacemark1);
            @endif
        }
    </script>
@stop