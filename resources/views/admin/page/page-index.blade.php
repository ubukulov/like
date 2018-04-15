@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список страницы
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/page/new') }}" class="btn btn-adn">Добавить страницу</a>
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
                                <th>Дата публикации</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($pages as $page) :?>
                            <tr>
                                <td>
                                    {{ $page->id }}
                                </td>
                                <td>
                                    {{ $page->name_ru }}
                                </td>
                                <td>
                                    {{ $page->created_at }}
                                </td>
                                <td>
                                    <a href="{{ url('/admin/page/'.$page->id) }}" class="btn btn-warning">Редактировать</a>
                                    <button onclick="delete_page({{ $page->id }});" class="btn btn-danger">Удалить</button>
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