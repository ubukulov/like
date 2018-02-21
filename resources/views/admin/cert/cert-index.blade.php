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
                        <a href="{{ url('admin/cert/new') }}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Добавить задания</a>
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
                                    <th>Партнер</th>
                                    <th>Название</th>
                                    <th>Покупок</th>
                                    <th>Дата публикации</th>
                                    <th>Дата окончания</th>
                                    <th colspan="2">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($certs as $cert) :?>
                                <tr>
                                    <td>
                                        {{ $cert->id }}
                                    </td>
                                    <td>
                                        @if(!empty($cert->image) AND file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/certs/'.$cert->image))
                                        <img src="{{ asset('uploads/certs/'.$cert->image) }}" alt="" height="40" width="60" />{{ $cert->partner }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($cert->features) OR !empty($cert->image))
                                        {{ $cert->title }}
                                        @else
                                        {{ $cert->title }} <font style="color: red;">( нет картинки и описание )</font>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $cert->purchased }}
                                    </td>
                                    <td>
                                        {{ date("d-m-Y H:i:s", $cert->date_start) }}
                                    </td>
                                    <td>
                                        {{ date("d-m-Y H:i:s", $cert->date_end) }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/cert/'.$cert->id) }}" class="btn btn-warning">Редактировать</a>
                                    </td>
                                    @if(check_admin_users_role(Auth::guard('admin')->user()->role))
                                    <td>
                                        <button onclick="delete_cert({{ $cert->id }});" class="btn btn-danger">Удалить</button>
                                    </td>
                                    @endif
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $certs->links() }}
                </div>
                <!-- /.box -->
        </div>
    </section>
@stop