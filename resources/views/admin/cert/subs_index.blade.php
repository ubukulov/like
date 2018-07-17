@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список сертификатов
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/certs/subs/создать') }}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Добавить сертификата</a>
                        <br><br>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!!Session::get('message')!!}
                            </div>
                        @endif
                        <h3>Используйте поиск</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="cert_title" class="form-control" placeholder="Наименование">
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" onclick="search_cert_by_title();" style="width: 150px;" class="btn btn-success">Поиск</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Товар</th>
                                <th>Название</th>
                                <th>Цена без скидки</th>
                                <th>Цена со скидкой</th>
                                <th>Скидка, %</th>
                                <th>Лимит покупок</th>
                                <th>Дата публикации</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody id="cert_content">
                            <?php foreach($cert_subs as $cert) :?>
                            <tr>
                                <td>
                                    {{ $cert->id }}
                                </td>
                                <td>
                                    @if(!empty($cert->image) AND file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/certs/'.$cert->image))
                                        <img align="left" src="{{ asset('uploads/certs/'.$cert->image) }}" alt="" height="40" width="60" />{{ $cert->c_title }}
                                    @endif
                                </td>
                                <td>
                                    {{ $cert->title }}
                                </td>
                                <td>
                                    {{ number_format($cert->price,0,' ',' ') }}
                                </td>
                                <td>
                                    {{ number_format($cert->price_minus,0,' ',' ') }}
                                </td>
                                <td>
                                    {{ $cert->percent }}
                                </td>
                                <td>
                                    {{ $cert->limit }}
                                </td>
                                <td>
                                    {{ $cert->created_at }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/sub/'.$cert->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                @if(check_admin_users_role(Auth::guard('admin')->user()->role))
                                    <td>
                                        <button onclick="delete_cert_sub({{ $cert->id }});" class="btn btn-danger">Удалить</button>
                                    </td>
                                @endif
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $cert_subs->links() }}
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop