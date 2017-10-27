@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список заказов
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!!Session::get('message')!!}
                            </div>
                        @endif
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Тип заказа</th>
                                <th>Кол-во</th>
                                <th>Цена</th>
                                {{--<th>Имя</th>--}}
                                {{--<th>Контакты</th>--}}
                                {{--<th>Адрес</th>--}}
                                {{--<th>Вид оплаты</th>--}}
                                {{--<th>Поставщик</th>--}}
                                {{--<th>Контакты</th>--}}
                                {{--<th>Адрес</th>--}}
                                {{--<th>Магазин</th>--}}
                                <th>Статус</th>
                                <th>Дата заявки</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($orders as $item) :?>
                            <tr @if($item->status == '0') class="yellow" @elseif($item->status == '1') class="bg-aqua" @elseif($item->status == '2') class="bg-orange" @elseif($item->status == '3') class="bg-green" @elseif($item->status == '4') class="bg-red"  @endif>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->title }}
                                </td>
                                <td>
                                    @if($item->type_order == 0)
                                        Обычный
                                    @else
                                        В 1 клик
                                    @endif
                                </td>
                                <td>
                                    {{ $item->qty }}
                                </td>
                                <td>
                                    {{ $item->price }}
                                </td>
                                {{--<td>--}}
                                    {{--{{ $item->client_name }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->client_phone }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->address }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@if($item->payment_type == 1) Со счета Likemoney @endif--}}
                                    {{--@if($item->payment_type == 2) QIWI терминалы @endif--}}
                                    {{--@if($item->payment_type == 3) Visa/Mastercard @endif--}}
                                    {{--@if($item->payment_type == 4) Наличными при получении @endif--}}
                                    {{--@if($item->payment_type == 5) Оплата в офисе @endif--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->name }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->mphone }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->p_address }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $item->store_name }}--}}
                                {{--</td>--}}
                                <td>
                                    @if($item->status == '0') Свободные @endif
                                    @if($item->status == '1') В обработке @endif
                                    @if($item->status == '2') Доставлен @endif
                                    @if($item->status == '3') Оплачен @endif
                                    @if($item->status == '4') Возврат @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td style="width: 300px;">
                                    <select style="cursor: pointer; width: 130px; float: left; margin-right: 15px;" name="status" id="status{{ $item->id }}" class="form-control">
                                        <option @if($item->status == '0') selected="selected" @endif value="0">Свободные</option>
                                        <option @if($item->status == '1') selected="selected" @endif value="1">В обработке</option>
                                        <option @if($item->status == '2') selected="selected" @endif value="2">Доставлен</option>
                                        <option @if($item->status == '3') selected="selected" @endif value="3">Оплачен</option>
                                        <option @if($item->status == '4') selected="selected" @endif value="4">Возврат</option>
                                    </select>
                                    <button style="margin-right: 10px;" type="button" onclick="confirm_store_order({{ $item->id }});" class="btn btn-success">Подтвердить</button>
                                    <a style="color: #ffffff !important;" href="{{ url('admin/order/'.$item->id) }}"><i class="fa fa-search"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop