@extends('partner.layout.partner')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4>Список отправленные подарки</h4>
            <table class="table table-bordered">
                <th>Испольнитель</th><th>Наименование подарка</th><th>СМС КОД</th><th>Дата</th>
                @foreach($gifts as $gift)
                    <tr>
                        <td>
                            <img class="ui avatar image" @if(!empty($gift->avatar)) src="{{ asset('uploads/users/small/'.$gift->avatar) }}" @else src="{{ asset('img/blank_avatar_80.png') }}" @endif>
                            {{ $gift->firstname." ".$gift->lastname }}
                        </td>
                        <td>
                            {{ $gift->name_ru }}
                        </td>
                        <td>{{ $gift->sms_code }}</td>
                        <td>{{ $gift->created }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop