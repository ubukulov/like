@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список типы задании
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/task/type_create') }}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Добавить тип задании</a>
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
                                <th>Наименование</th>
                                <th>Дата публикации</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($types as $type) :?>
                            <tr>
                                <td>
                                    {{ $type->id }}
                                </td>
                                <td>
                                    <img @if(!empty($type->image)) src="{{ asset('uploads/tasks/types/small/'.$type->image) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="" height="40" width="60" />
                                    {{ $type->name_ru }}
                                </td>
                                <td>
                                    {{ $type->created }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/task/type/'.$type->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                <td>
                                    <button onclick="delete_type_task({{ $type->id }});" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop