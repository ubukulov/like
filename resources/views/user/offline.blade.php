@extends('user/layout/user')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!!Session::get('message')!!}
        </div>
    @endif
    <h4>Регистрация оффлайн продажу</h4>
    <br>
    <div class="row">
        <div class="col-md-3">
            <input type="text" placeholder="Введите код товара" id="code_good" class="form-control">
        </div>
        <div class="col-md-3">
            <button class="btn btn-app" type="button" id="search_btn"><i class="icon search"></i>Поиск</button>
        </div>
    </div>
    <br>
    <hr>
    <form action="{{ url('/user/business/set_offline_order') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row" style="margin-left: 0px; margin-right: 0px;">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Наименование</label>
                    <input type="text" class="form-control" id="title" required="required" name="title" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="channel_sells">Каналы продаж</label>
                    <select name="channel_sells" id="channel_sells" class="form-control" style="width: 200px;">
                        <option value="0">Не указано</option>
                        <option value="1">Likemoney.me</option>
                        <option value="2">Instagram.com</option>
                        <option value="3">VK.com</option>
                        <option value="4">Olx.kz</option>
                        <option value="5">Market.kz</option>
                        <option value="6">Kolesa.kz</option>
                        <option value="7">Alfa.kz</option>
                        <option value="8">Радио</option>
                        <option value="9">Google</option>
                        <option value="10">Яндекс</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Выберите тип продажу</label>
                    <select name="type_order" id="type_order" class="form-control" style="width: 200px;">
                        <option value="1">Оптом</option>
                        <option value="2">Розницу</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Укажите кол-во</label>
                    <input type="text" class="form-control int" required name="count_sell" style="width: 200px;">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Укажите цену</label>
                    <input type="text" class="form-control int" required name="price_sell" style="width: 200px;">
                </div>
            </div>

        </div>

        <div class="row" id="order">
            <div class="col-md-3">
                <button type="submit" id="accept_order" disabled class="btn btn-success">Принять заказ</button>
            </div>
        </div>
    </form>
@stop