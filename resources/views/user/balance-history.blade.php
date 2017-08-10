@extends('user.layout.user')
@section('content')
    <h4><b>История баланса:</b><span style="font-size: 14px; color: #cc0000; margin-left: 10px;">Доход за сегодня: {{ $profit_today }} тг.</span>
    <span style="font-size: 14px; color: #cc0000; margin-left: 10px;">За неделю: {{ $profit_week }} тг.</span>
    <span style="font-size: 14px; color: #cc0000; margin-left: 10px;">За месяц: {{ $profit_month }} тг.</span>
    <br />&nbsp;</h4>
    <div class="row">
        <div class="col-md-12">
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
            {{ $balances->links() }}
        </div>
    </div>
@stop