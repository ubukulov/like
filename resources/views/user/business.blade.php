@extends('user/layout/user')
@section('content')
    <div class="rowtsk-bkg">
        <p style="font-size: 16px;">
            Подключите тариф "Business" и начните зарабатывать на продаже интересных предложений с супер скидками до 100%.
        </p>
        <br>
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('message') !!}
            </div>
        @endif
        <div class="ui huge form">
            <form action="{{ url('/user/business/set') }}" method="post">
                {{ csrf_field() }}
            <div class="inline fields">
                <label for="fruit">Выберите тариф:</label>
                <div class="field">
                    <div class="ui radio checkbox" style="font-size: 15px;">
                        <input type="radio" name="tariff" tabindex="0" @if($business_store->tarif == 1) checked="checked" @endif class="hidden" value="1">
                        <label>Business Silver</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox" style="font-size: 15px;">
                        <input type="radio" name="tariff" tabindex="0" @if($business_store->tarif == 2) checked="checked" @endif class="hidden" value="2">
                        <label>Business Gold</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox" style="font-size: 15px;">
                        <input type="radio" name="tariff" tabindex="0" @if($business_store->tarif == 3) checked="checked" @endif class="hidden" value="3">
                        <label>Business Premium</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="inline fields">
                <div class="eight wide field">
                    <label>Придумайте названия будущего магазина:</label>
                    <input type="text" placeholder="alizhan" value="{{ $business_store->store_name }}" required="required" name="store_name">
                </div>
            </div>
            <br>
            <div class="inline fields">
                <div class="eight wide field">
                    <div id="image1">
                        @if(!empty($business_store->store_img))
                        <img src="{{ asset('uploads/users/store/'.$business_store->store_img) }}" height="100" name="image1">
                        @else
                        <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                        @endif
                    </div>
                    <br>
                    <button id="upload1" class="blue">Выбрать логотип</button>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Отправить заявку!</button>
            </form>
        </div>
    </div>

    <div class="rowtsk-bkg">
        <h4>* Тариф будет активирован только после личной встречи с основателями сервиса Likemoney.me
            Запишитесь на нее по what's app 8 775 815 35 38</h4>
    </div>

    <div class="rowtsk-bkg">
        <h4>Как Вы будете зарабатывать?</h4>
        <br>
        <p>
            Предложите своего другу, коллеге или клиенту купить через Вас любое интересное предложение и получите оплату на Ваш счет.
            <br>
            Весь полученный доход, Вы всегда можете вывести на свою банковскую карточку любого банка.
        </p>

        <p>
            <img src="{{ asset('img/account_bussines_1.PNG') }}" alt="">
            <img src="{{ asset('img/account_bussines_2.PNG') }}" alt="">
            <img src="{{ asset('img/account_bussines_3.PNG') }}" alt="">
        </p>

        <p>
            Для начала заработка Вам необходимо авторизоваться и выбрать нужное предложение, затем указать кол-во предложений и данные
            <br>
            клиента: номер мобильного и email.
            Клиенту прийдет sms с секретном кодом, которое ему необходимо предьявить партнеру сайта Likemoney.me, чтобы получить услугу
            <br>или товар. После активации сертификата к Вам поступит на счет сумма дохода.
        </p>
    </div>
@stop