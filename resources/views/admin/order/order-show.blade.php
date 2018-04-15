@extends('admin.layout.default')
@section('content')
    <section class="content-header">
        <h1>
            Подробнее информация по заказу
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <input type="hidden" id="id_item" value="{{ $order->id }}">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" readonly class="form-control" value="{{ $order->title }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Количество</label>
                            <input type="text" id="cnt" readonly class="form-control deactivated int" value="{{ $order->qty }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Цена</label>
                            <input type="text" readonly class="form-control" value="{{ $order->price }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Сумма</label>
                            <input type="text" readonly class="form-control" value="@if(empty($order->cost_delivery) OR $order->cost_delivery == 0) {{  $order->qty * $order->price }} @else {{ $order->qty * $order->price }} + {{ $order->cost_delivery }} = {{ $order->qty * $order->price + $order->cost_delivery }} (с платной доставкой) @endif">
                        </div>

                        <div class="form-group">
                            <label for="firstname_customer">Имя покупателя</label>
                            <input type="text" id="firstname_customer" readonly class="form-control deactivated" value="{{ $order->client_name }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Телефон покупателя</label>
                            <input type="text" readonly class="form-control" value="{{ $order->client_phone }}">
                        </div>

                        <div class="form-group">
                            <label for="customer_address">Адрес покупателя</label>
                            <input type="text" id="customer_address" readonly class="form-control deactivated" value="{{ $order->address }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Интернет магазин</label>
                            <input type="text" readonly class="form-control" value="{{ $order->store_name }}">
                        </div>

                        <div class="form-group">
                            <label for="channel_sells">Каналы продаж</label>
                            <select name="channel_sells" id="channel_sells" class="form-control">
                                <option @if($order->channel_sells == 0) selected="selected" @endif value="0">Не указыно</option>
                                <option @if($order->channel_sells == 1) selected="selected" @endif value="1">Likemoney.me</option>
                                <option @if($order->channel_sells == 2) selected="selected" @endif value="2">Instagram.com</option>
                                <option @if($order->channel_sells == 3) selected="selected" @endif value="3">VK.com</option>
                                <option @if($order->channel_sells == 4) selected="selected" @endif value="4">Olx.kz</option>
                                <option @if($order->channel_sells == 5) selected="selected" @endif value="5">Market.kz</option>
                                <option @if($order->channel_sells == 6) selected="selected" @endif value="6">Kolesa.kz</option>
                                <option @if($order->channel_sells == 7) selected="selected" @endif value="7">Alfa.kz</option>
                                <option @if($order->channel_sells == 8) selected="selected" @endif value="8">Радио</option>
                                <option @if($order->channel_sells == 9) selected="selected" @endif value="9">Google</option>
                                <option @if($order->channel_sells == 10) selected="selected" @endif value="10">Яндекс</option>
                            </select>
                        </div>
                        @if(empty($order->qty) AND empty($order->price))
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="deactivated">Деактивировать поля</button>
                            <button type="button" disabled="disabled" class="btn btn-success" id="activated">Сохранить данные</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Вид оплаты</label>
                            <select id="tp" class="form-control deactivated" disabled="disabled">
                                <option @if(empty($order->payment_type)) selected="selected" @endif value="0">Укажите вид оплаты</option>
                                <option @if($order->payment_type == 1) selected="selected" @endif value="1">Со счета Likemoney</option>
                                <option @if($order->payment_type == 2) selected="selected" @endif value="2">QIWI терминалы</option>
                                <option @if($order->payment_type == 3) selected="selected" @endif value="3">Visa/Mastercard</option>
                                <option @if($order->payment_type == 4) selected="selected" @endif value="4">Наличными при получении</option>
                                <option @if($order->payment_type == 5) selected="selected" @endif value="5">Оплата в офисе</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Поставщик</label>
                            <input type="text" readonly class="form-control" value="{{ $order->name }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Телефон</label>
                            <input type="text" readonly class="form-control" value="{{ $order->mphone }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Адрес</label>
                            <input type="text" readonly class="form-control" value="{{ $order->p_address }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Цена поставщика (Себестоимость)</label>
                            <input type="text" readonly class="form-control" value="{{ $order->prime_cost }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Доставка</label>
                            <select name="id_cost_delivery" style="cursor: pointer;" id="id_cost_delivery" class="form-control">
                                <option @if($order->id_delivery == '0') selected="selected" @endif value="0">Бесплатно</option>
                                <option @if($order->id_delivery == '1') selected="selected" @endif value="1">Платно</option>
                            </select>
                        </div>

                        <div id="delivery" @if(empty($order->cost_delivery) OR $order->cost_delivery == 0) style="display: none;" @endif class="form-group">
                            <label for="title">Стоимость доставки</label>
                            <input type="text" class="form-control int" id="cost_delivery" value="{{ $order->cost_delivery }}">
                        </div>

                        <div id="btn_delivery" class="form-group">
                            <button type="button" onclick="cost_delivery({{ $order->id }});" class="btn btn-warning">Учитывать расходы на доставки</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop