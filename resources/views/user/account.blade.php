@extends('user/layout/user')
@section('content')
    <div class="ui huge form">
        <div class="three fields">
            <div class="field">
                <div class="blog-heading">
                    <h3>Карта Likemoney.me</h3>
                </div>

                <input style="width: 150px;" value="{{ getCardNumberByUserID(Auth::id()) }}" id="account_card_num" class="form-control int" maxlength="8" placeholder="Номер карты" disabled="disabled">
                <br><br>
                <div class="ui list">
                    <a class="item">Какие возможности дает карта?</a>
                    <a class="item">Где можно приобрести карту?</a>
                    <a class="item">Как сменить пин-код карты?</a>
                </div>
            </div>

            <div class="field">
                <img src="{{ asset('img/card.png') }}" alt="card_likemone.me" align="right" class="img-responsive">
            </div>

            <div class="field" style="text-align: center;">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <span>Для вывода средств необходима Ваша карта любого банка, загрузите фото лицевой части</span>
                <div id="image1">
                    @if(!empty(Auth::user()->bank_card))
                        <img  src="{{ asset('uploads/users/bank/'.Auth::user()->bank_card) }}">
                    @else
                        <img src="{{ asset('img/no_photo227x140.png') }}" alt="">
                    @endif
                </div>
                <br>
                <button type="button" style="width: 50%; margin-left: 20%;" id="upload5" class="btn btn-success">Загрузить</button>
                <div id="msg" class="hidden"></div>
            </div>
        </div>
    </div>

    <br>
    <div class="blog-heading">
        <h3>Вывод средств</h3>
    </div>
    <table class="table">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <tr>
            <td>
                <div class="form-inline">
                    <img src="{{ asset('img/li_1.png') }}">
                    <div class="form-group">
                        <label for="exampleInputName2">&nbsp;&nbsp;Укажите сумму:&nbsp;&nbsp;&nbsp;</label>
                        <input maxlength="5" id="vyvod_amount" name="vyvod_amount" type="text" class="form-control int" placeholder="Введите сумму">
                    </div>
                    <span id="vyvod_commission">-комиссия%</span>
                    <font color="#d7d7d7"><i class="fa fa-question-circle fa-2"></i></font>&nbsp;
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="form-inline">
                    <img src="{{ asset('img/li_2.png') }}">
                    <div class="form-group">
                        <label for="exampleInputName2">&nbsp;&nbsp;К выводу:&nbsp;&nbsp;&nbsp;</label>
                        <input style="width: 100px" disabled="" id="vyvod_amount_total" name="amount" type="text" class="form-control int" placeholder="сумма">
                        тг.
                        <input rel="txtTooltip" maxlength="4" style="width: 100px; display: none" id="vyvod_sms" class="form-control int" placeholder="смс код" data-toggle="tooltip" title="Введите 4-х значный смс код который был выслан на ваш телефон" />
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="form-inline">
                    <img src="{{ asset('img/li_3.png') }}">&nbsp;&nbsp;
                    <button onclick="account.withdraw();" id="btn_vyvod" type="submit" class="btn btn-danger">Заказать вывод</button>
                </div>
            </td>
        </tr>
    </table>
    <div id="msg" class="hidden"></div>
@stop