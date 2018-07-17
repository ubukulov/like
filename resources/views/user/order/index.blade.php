@extends('user/layout/user')
@section('content')
    <h4>Мои заказы</h4>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!!Session::get('message')!!}
        </div>
    @endif
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <th>ID</th><th>Наименование</th><th>Тип</th><th>Кол-во</th><th>Цена</th><th>Статус</th><th>Данные клиента</th><th>Вознаграждение</th><th>Действие</th>
            <th>Дата</th>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->title }}</td>
                    <th>
                        @if($order->type_order == 0)
                            Обычный
                        @elseif($order->type_order == 1)
                            В 1 клик
                        @else
                            Оффлайн
                        @endif
                    </th>
                    <td>{{ $order->qty }}</td>
                    <td>{{ number_format((int) $order->price,0,' ',' ') }} тг</td>
                    <td>
                        @if($order->status == '0') Свободные @endif
                        @if($order->status == '1') В обработке @endif
                        @if($order->status == '2') Доставлен @endif
                        @if($order->status == '3') Оплачен @endif
                        @if($order->status == '4') Возврат @endif
                    </td>
                    <td>
                        Имя    : {{ $order->client_name }} <br>
                        Телефон: {{ $order->client_phone }} <br>
                        Адрес  : {{ $order->address }}
                    </td>
                    <td>
                        {{ number_format((int) $order->com_agent,0,' ',' ') }} тг
                    </td>
                    <td>
                        @if($order->status == '3')
                        Заказ уже одобрено.
                        @else
                        <a href="{{ url('user/order/approve/' . $order->id) }}">Одобрить</a>
                        @endif

                    </td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@stop