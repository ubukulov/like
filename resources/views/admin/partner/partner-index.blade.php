@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список партнеров
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/partner/create') }}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Добавить партнера</a>
                        <br><br>
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
                                <th>Название</th>
                                <th>Телефон</th>
                                <th>Адрес</th>
                                <th>Логин</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($partners as $partner) :?>
                            <tr>
                                <td>
                                    {{ $partner->id }}
                                </td>
                                <td>
                                    {{ $partner->name }}
                                </td>
                                <td>
                                    {{ $partner->phone }}
                                </td>
                                <td>
                                    {{ $partner->address }}
                                </td>
                                <td>
                                    {{ $partner->username }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/partner/'.$partner->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                <td>
                                    <button onclick="delete_partner({{ $partner->id }});" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $partners->links() }}
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop