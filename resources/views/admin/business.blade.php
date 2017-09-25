@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список заявок на открытие магазин
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
                                <th>Пользователь</th>
                                <th>Баланс</th>
                                <th>Тариф</th>
                                <th>Названия магазина</th>
                                <th>Статус</th>
                                <th>Дата заявки</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($withdraw as $item) :?>
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    @if(getUserData($item->id_user)->avatar)
                                        <img src="{{ asset('uploads/users/small/'.getUserData($item->id_user)->avatar) }}" alt="" height="40" width="40" />
                                    @else
                                        <img src="{{ asset('img/blank_avatar_220.png') }}" alt="" height="40" width="40" />
                                    @endif
                                    {{ getUserData($item->id_user)->firstname . " " .getUserData($item->id_user)->lastname }}
                                </td>
                                <td>
                                    {{ __decode(getUserData($item->id_user)->fm, env('KEY')) }} тг
                                </td>
                                <td>
                                    @if($item->tarif == '0') Не выбран @endif
                                    @if($item->tarif == '1') Silver @endif
                                    @if($item->tarif == '2') Gold @endif
                                    @if($item->tarif == '3') Premium @endif
                                </td>
                                <td>
                                    {{ $item->store_name }} .likemoney.me
                                </td>
                                <td>
                                    @if($item->status == '0') Ожидает @endif
                                    @if($item->status == '1') Одобрено @endif
                                    @if($item->status == '2') Отменен @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <a href="{{ url('/admin/business/up/'.$item->id) }}" class="btn btn-warning">Одобрить</a>
                                    <button type="button" class="btn btn-danger">Отменить</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        {{ $withdraw->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop