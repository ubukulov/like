@extends('partner.layout.partner')
@section('content')
    <h3>Форма добавление задании</h3>
    <br>
    <form action="{{ url('partner/task/store') }}" method="post" class="ui large form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" id="money" value="1" name="money"/>
        <input type="hidden" id="gift" value="1" name="gift"/>
        <div class="field">
            <label>Названия</label>
            <input type="text" name="title" placeholder="Названия" required="required">
        </div>
        <div class="field">
            <label>Описание задании</label>
            <textarea id="info_editor" name="text" rows="4"></textarea>
        </div>
        <div class="field">
            <label>Укажите тип задании</label>
            <select id="id_type" name="id_type" class="ui search dropdown">
                @foreach($task_types as $type)
                <option value="{{ $type->id }}">{{ $type->name_ru }}</option>
                @endforeach
            </select>
        </div>
        <div class="two fields">
            <div class="field">
                <div class="inline field">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="task_variant1" id="task_variant1">
                        <label style="font-size: 14px;"><strong>Оплатить услуги денгами</strong></label>
                    </div>
                </div>
                <br>
                <div id="task_money1" class="two fields task_money" style="display: none;">
                    <div class="field" style="width: 50px;vertical-align: middle;padding: 34px 25px;">
                        <span style="font-weight: bold;font-size: 20px;">1</span>
                    </div>
                    <div class="field" style="width: 400px;">
                        <div class="ui left action input">
                            <button type="button" style="width: 150px;" class="ui small teal labeled icon button">
                                <i class="payment icon"></i>
                                Стоимость
                            </button>
                            <input type="text" placeholder="Введите сумму" name="amount1">
                        </div>
                        <br><br>
                        <div class="ui left action input">
                            <button type="button" style="width: 150px;" class="ui small orange labeled icon button">
                                <i class="tag icon"></i>
                                Количество предложений
                            </button>
                            <input type="text" placeholder="Введите" name="count1">
                        </div>
                    </div>
                </div>
                <div id="taskButton_money" style="margin-top: 15px; display: none;">
                    <button type="button" onclick="taskButton_money();">Добавить еще вариант</button>
                </div>
            </div>
            <div class="field">
                <div class="inline field">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="task_variant2" id="task_variant2">
                        <label style="font-size: 14px;"><strong>Оплатить услуги подарками</strong></label>
                    </div>
                </div>
                <br>
                <div id="task_gift1" class="two fields task_gift" style="display: none;">
                    <div class="field" style="width: 50px;vertical-align: middle;padding: 34px 25px;">
                        <span style="font-weight: bold;font-size: 20px;">1</span>
                    </div>
                    <div class="field" style="width: 400px;">
                        <div class="ui left action input">
                            <button type="button" style="width: 150px;" class="ui small blue teal labeled icon button">
                                <i class="payment icon"></i>
                                Наименование
                            </button>
                            <input type="text" placeholder="Название" name="gift_name1">
                        </div>
                        <br><br>
                        <div class="ui left action input">
                            <button type="button" style="width: 150px;" class="ui small labeled icon button">
                                <i class="tag icon"></i>
                                Количество предложений
                            </button>
                            <input type="text" placeholder="Введите" name="gift_count1">
                        </div>
                    </div>
                </div>
                <div id="taskButton_gift" style="margin-top: 15px;display: none;">
                    <button type="button" onclick="taskButton_gift();">Добавить еще вариант</button>
                </div>
            </div>
        </div>
        <br>
        <div class="two fields">
            <div class="field">
                <label><strong>Укажите ссылку на похожые работы</strong></label>
                <div class="ui small labeled input">
                    <div class="ui label">
                        Ссылка
                    </div>
                    <input type="text" placeholder="mysite.com" name="related_works">
                </div>
            </div>

            <div class="field">
                <div class="ui small image">
                    <div id="image1">
                        <img src="{{ asset('img/image.png') }}">
                    </div>
                    <br>
                    <button type="button" id="upload1" class="ui small button">Выбрать обложку задания</button>
                </div>
            </div>
        </div>

        <br>

        <div class="field">
            <button class="ui large green button" type="submit"><i class="save icon"></i>&nbsp;&nbsp;Сохранить задания</button>
        </div>

    </form>
@stop