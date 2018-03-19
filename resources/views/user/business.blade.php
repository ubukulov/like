@extends('user/layout/user')
@section('content')
    <div class="rowtsk-bkg">
        @if(check_user_store_tarif(Auth::id()))
        <div class="alert alert-success alert-dismissable">
            Ваш интернет магазин успешно создан! <br>
            Доступен по адресу: <a href="http://{{ get_user_store_name(Auth::id()) }}" target="_blank">{{ get_user_store_name(Auth::id()) }}</a>
        </div>
        @endif
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
                        <input type="radio" name="tariff" tabindex="0" @if(isset($business_store) AND $business_store->tarif == 1) checked="checked" @endif class="hidden" value="1">
                        <label>Business Silver</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox" style="font-size: 15px;">
                        <input type="radio" name="tariff" tabindex="0" @if(isset($business_store) AND $business_store->tarif == 2) checked="checked" @endif class="hidden" value="2">
                        <label>Business Gold</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox" style="font-size: 15px;">
                        <input type="radio" name="tariff" tabindex="0" @if(isset($business_store) AND $business_store->tarif == 3) checked="checked" @endif class="hidden" value="3">
                        <label>Business Premium</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="inline fields">
                <div class="eight wide field">
                    <label>Придумайте названия будущего магазина:</label>
                    <input type="text" placeholder="alizhan" @if(isset($business_store)) value="{{ $business_store->store_name }}" @endif required="required" name="store_name">
                </div>
            </div>
            <br>
            <div class="inline fields">
                <div class="eight wide field">
                    <label>Укажите номер телефона (Whats app):</label>
                    <input type="text" class="phone" id="store_phone" placeholder="+7 (777)-777-88-99" required="required" name="store_phone"  value="{{ $business_store->store_phone }}">
                </div>
            </div>
            <br>
            <div class="inline fields">
                <div class="eight wide field">
                    <div id="image1">
                        @if(!empty(isset($business_store) AND $business_store->store_img))
                        <img src="{{ asset('uploads/users/store/'.$business_store->store_img) }}" height="100" name="image1">
                        @else
                        <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                        @endif
                    </div>
                    <br>
                    <button type="button" id="upload5" class="blue">Выбрать логотип</button>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Отправить заявку!</button>
            </form>
        </div>
    </div>

    <div class="rowtsk-bkg">
		<h4>Список лэндингов</h4>
        <div class="row">
            <div class="col-md-4">
                Роза в колбе
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" readonly value="http://likemoney.me/rose_flask">
            </div>
        </div>
		<br /><br />
		<div class="row">
            <div class="col-md-4">
                Samsung Galaxy S9
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" readonly value="http://likemoney.me/samsung_s9">
            </div>
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