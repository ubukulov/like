@extends('partner.layout.partner')
@section('content')
    <table class="table">
        <thead>
            <th><b>Варианты вознаграждения:</b></th>
            <th><b>Чек:</b></th>
            <th><b>Скидка:</b></th>
            <th><b>Сумма:</b></th>
            <th><b>Вознаграждение:</b></th>
        </thead>
        <tbody>
        @foreach ($certs_sub as $key=>$sub)

        <input  type="hidden" name="sub[<?= $key ?>][id]" value="<?= $sub->id; ?>">
        <input class="pay2_sum_vvod_<?= $sub->id; ?>" type="hidden" name="sub[<?= $key ?>][sum_vvod]" value="0">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <tr>
            <td>
                {{ $sub->title }}
            </td>

            <td>
                <input maxlength="7" type="text" class="int form-control pay2_sum_vvod" data-sub='<? echo json_encode($sub);?>'  placeholder="Ввести">
            </td>

            <td>
                <?= $sub->percent; ?> %
            </td>

            <td class="pay2_sum_<?= $sub->id; ?>"></td>

            <td class="pay2_sum_nachislen pay2_sum_nachislen_<?= $sub->id; ?>"></td>
        </tr>

        @endforeach
        <tr>
            <td colspan="2">

                <style>
                    .card_info_user{
                        padding: 10px;
                        border: 1px solid #D7D7D7;
                        width: 307px;
                        background-color: #F8F8F8;
                        border-radius: 3px;
                        height: 170px;
                    }
                </style>

                <div class="card_info_user">
                    <table>
                        <tbody>

                        <tr>
                            <td colspan="2">Данные о пользователе:</td>

                        </tr>

                        <tr>
                            <td width="140">
                                <img id="card_avatar" src="" width="100" height="100" alt="" style="display: inline;">
                            </td>
                            <td valign="top">
                                <span id="card_username" style="display: inline;">Карта не найдена!</span>
                                <div id="acc"></div>
                                <div id="act"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </td>


            <td colspan="2" style="text-align:right;"><b>Итого:</b>&nbsp;&nbsp;
                <font style="font-family:ubuntu; font-size:20px;">
                    <span id="kupon_all_sum">0</span> тг.
                </font>

                <div  class="status_payment">
                    &nbsp;
                </div>


            </td>
        </tr>
        </tbody>
    </table>
        <figure class="highlight-pay">
            <pre-pay>
                <form class="form-inline" onsubmit="return false;">
                    <div class="form-group">
                        <label style="width: 200px;" for="exampleInputName2">Введите № карты агента:&nbsp;</label>
                        <input style="width: 150px; text-align:center;" id="partner_card_num" type="text" class="form-control int input-lg" maxlength="8" placeholder="Номер карты">
                    </div>
                    <font color="#d7d7d7"><i class="fa fa-question-circle fa-2"></i></font>
                    <button type="submit" onclick="pay_to_user_percent()" id="spisat_summu" disabled="disabled" name="submit" class="btn btn-danger">Начислить вознаграждение</button>
                </form>
            </pre-pay>
        </figure>
        <div style="float:right; margin-top:20px;">
            Остаток на счету:
            <font style="font-family:ubuntu; font-size:16px; color:#619F05;">{{ __decode(Auth::guard('partner')->user()->fm, env('KEY')) }} тг.</font>
        </div>
        <br>
        <b>Статистика по вознаграждениям:</b>
        <br />
        <br />
        <table class="table" width="100%">
            <tr>
                <td><b>Варианты вознаграждения:</b></td>
                <td><b>Кол-во:</b></td>
                <td><b>Сумма:</b></td>
                <td><b>Комиссия:</b></td>
                <td><b>Агент:</b></td>
                <td><b>Дата:</b></td>
            </tr>
            @foreach($transactions as $transaction)
            <tr>
                <td>
                    {{ $transaction->title }}
                </td>
                <td>
                    {{ $transaction->count }}
                </td>
                <td>
                    {{ $transaction->sum }} тг.
                </td>
                <td>
                    {{ $transaction->sum_minus - $transaction->sum }} тг.
                </td>
                <td>
                    {{ getUser($transaction->user_id) }}
                </td>
                <td  id="verticalText">
                    {{ date('d-m-Y H:i:s', $transaction->date) }}
                </td>
                <style>
                    #verticalText {
                        writing-mode: tb-rl;
                        font-size: 12px;
                        font-weight: bold;
                        line-height: 11px;
                    }

                </style>

            </tr>
            @endforeach
            {{ $transactions->links() }}

        </table>
@stop