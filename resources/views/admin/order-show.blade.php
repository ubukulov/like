@extends('admin/layout/default')
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
                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" readonly class="form-control" value="{{ $order->title }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Количество</label>
                            <input type="text" readonly class="form-control" value="{{ $order->qty }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Цена</label>
                            <input type="text" readonly class="form-control" value="{{ $order->price }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Сумма</label>
                            <input type="text" readonly class="form-control" value="@if(empty($order->cost_delivery) OR $order->cost_delivery == 0) {{  $order->qty * $order->price }} @else {{ $order->qty * $order->price + $order->cost_delivery }} (с платной доставкой) @endif">
                        </div>

                        <div class="form-group">
                            <label for="title">Имя покупателя</label>
                            <input type="text" readonly class="form-control" value="{{ $order->client_name }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Телефон покупателя</label>
                            <input type="text" readonly class="form-control" value="{{ $order->client_phone }}">
                        </div>

                        <div class="form-group">
                            <label for="title">Адрес покупателя</label>
                            <input type="text" readonly class="form-control" value="{{ $order->p_address }}">
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Вид оплаты</label>
                            <input type="text" readonly class="form-control"
                            value="@if($order->payment_type == 1) Со счета Likemoney @endif @if($order->payment_type == 2) QIWI терминалы @endif @if($order->payment_type == 3) Visa/Mastercard @endif @if($order->payment_type == 4) Наличными при получении @endif @if($order->payment_type == 5) Оплата в офисе @endif ">
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
                            <input type="text" readonly class="form-control" value="{{ $order->address }}">
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