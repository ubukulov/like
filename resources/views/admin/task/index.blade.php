@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список задании
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
                                <th>Партнер</th>
                                <th>Название</th>
                                <th>Дата публикации</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($tasks as $task) :?>
                            <tr>
                                <td>
                                    {{ $task->id }}
                                </td>
                                <td class="avatar">
                                    <img src="{{ asset('uploads/partners/small/'.$task->partner_image) }}" alt="" height="40" width="60" />
                                    {{ $task->partner_name }}
                                </td>
                                <td>
                                    {{ $task->title }}
                                </td>
                                <td>
                                    {{ $task->created }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/task/'.$task->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                <td>
                                    <button onclick="delete_task({{ $task->id }});" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $tasks->links() }}
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop