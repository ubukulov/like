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

            <div class="field">
                <h4 style="text-align: center;"><strong>Вывод средств</strong></h4>
                <br>
                <div class="ui left action input">
                    <button type="button" style="width: 170px;" class="ui big teal labeled icon button">
                        <i class="payment icon"></i>
                        Укажите сумму
                    </button>
                    <input type="text" value="$52.03">
                </div>
                <span>Комиссия: 300тг</span>
            </div>
        </div>
    </div>

    <br>
    <div class="blog-heading">
        <h3>Вывод средств</h3>
    </div>
    <table class="table">
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
                    <button onclick="account.vyvod_send_sms_code()" id="btn_vyvod" type="submit" class="btn btn-danger">вывод</button>

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

                    <button onclick="account.vyvod_get()" id="btn_vyvod_get" style="display: none"   class="btn btn-danger">подтвердить</button>
                </div>
            </td>
        </tr>
    </table>
@stop