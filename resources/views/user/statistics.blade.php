@extends('user/layout/user')
@section('content')
    <h4>Общая статистика (только оплаченные заказы)</h4>
    <table class="table table-bordered">
        <thead>
            <th>#</th>
            <th>Месяц</th>
            <th>Кол-во продаж</th>
            <th>Общая сумма продаж (тенге)</th>
            <th>Ваш прибыль (тенге)</th>
        </thead>
        <tbody>
        @foreach($result as $value)
            <tr>
                <td></td>
                <td>{{ $value->mnt }}</td>
                <td>{{ $value->cnt }}</td>
                <td>{{ $value->summ }}</td>
                <td>{{ $value->profit }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4>Все заказы</h4>
    <table class="table table-bordered" style="font-size: 12px;">
        <thead>
        <th>#</th>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Стоимость</th>
        <th>Статус</th>
        <th>Оплата</th>
        <th>Адрес</th>
        <th>Доставка</th>
        <th>Месяц</th>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->client_name }}</td>
                <td>{{ $order->client_phone }}</td>
                <td>{{ $order->ptitle }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ $order->price }}</td>
                <td>
                    @if($order->status == '0') Свободные @endif
                    @if($order->status == '1') В обработке @endif
                    @if($order->status == '2') Доставлен @endif
                    @if($order->status == '3') Оплачен @endif
                    @if($order->status == '4') Возврат @endif
                </td>
                <td>
                    @if($order->payment_type == 1) Со счета Likemoney @endif
                    @if($order->payment_type == 2) QIWI терминалы @endif
                    @if($order->payment_type == 3) Visa/Mastercard @endif
                    @if($order->payment_type == 4) Наличными при получении @endif
                    @if($order->payment_type == 5) Оплата в офисе @endif
                </td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->cost_delivery }}</td>
                <td>{{ $order->mnt }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


    @if(isset($result) AND count($result) > 0)
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
        $scrypt = '<script type="text/javascript">';
        $scrypt .= 'google.charts.load("current", {packages:["corechart"]});';
        $scrypt .= 'google.charts.setOnLoadCallback(drawChart);';
        $scrypt .= 'function drawChart() {';
        $scrypt .=      "var data = google.visualization.arrayToDataTable([['X', 'Количество продаж'],";
            $cnt = count($result);
            $t = 0;
            for($i=0; $i<count($result); $i++){
                $t = $i + 1;
                if($t == $cnt){
                    $scrypt .= "['".$result[$i]->mnt."', ".$result[$i]->cnt."]";
                }else{
                    $scrypt .= "['".$result[$i]->mnt."', ".$result[$i]->cnt."],";
                }

            }
        $scrypt .= ']);';

        $scrypt .= 'var options = {';
            $scrypt .= "legend: 'none',colors: ['#15A0C8'],pointSize: 15,pointShape: { type: 'circle', rotation: 180 }};";
            $scrypt .= "var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));";
            $scrypt .= "chart.draw(data, options);}</script>";
        echo $scrypt;
    ?>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    @endif
@stop