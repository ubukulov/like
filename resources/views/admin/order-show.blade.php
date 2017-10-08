@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Информация по заказу
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
                            <input type="text" readonly class="form-control" value="{{ $order->qty * $order->price }}">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop