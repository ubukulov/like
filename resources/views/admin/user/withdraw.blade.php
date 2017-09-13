@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список заявок
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
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Дата</th>
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
                                    {{ $item->amount }} тг.
                                </td>
                                <td>
                                    @if($item->status == '0')
                                        Ожидает
                                    @elseif($item->status == '1')
                                        Начислено
                                    @else
                                        Отменен платеж
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <a @if($item->status == '1') href="#" disabled="disabled" @else href="{{ url('admin/withdraw/'.$item->id) }}" @endif class="btn btn-warning">Одобрить</a>
                                    <a @if($item->status == '1') href="#" disabled="disabled" @else href="{{ url('admin/withdraw/cancel/'.$item->id) }}" @endif class="btn btn-danger">Отменить</a>
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