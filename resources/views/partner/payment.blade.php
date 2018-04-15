@extends('partner.layout.partner')
@section('content')
    <form action="{{ url('/partner/paybox/payment') }}" method="post">
        {{ csrf_field() }}
        <div class="field">
            <h4 style="text-align: center;"><strong>Пополнение счета</strong></h4>
            <br>
            <div class="ui left action input">
                <button type="button" style="width: 200px;" class="ui small teal labeled icon button">
                    <i class="payment icon"></i>
                    Укажите сумму в тенге
                </button>
                <input type="text" name="amount" class="int" required="required" maxlength="8" placeholder="Введите сумму">
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="submit" class="btn btn-success">Перейти к оплате</button>
            </div>
        </div>
    </form>
@stop