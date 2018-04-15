@extends('partner.layout.partner')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Список работы</h4>
            <table class="table table-bordered">
                <th>Доход / Расход</th><th>Статус</th><th>Описание</th><th>Дата</th>
                @foreach($balances as $balance)
                    <tr>
                        <td>{{ $balance->type.$balance->amount }}</td>
                        <td>
                            @if($balance->type == '+') поступило @endif
                            @if($balance->type == '-') снято @endif
                            @if($balance->type == '?') в ожидании @endif
                        </td>
                        <td><p>{!! $balance->description !!}</p></td>
                        <td>{{ date('d.m.Y H:i:s', $balance->date) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop