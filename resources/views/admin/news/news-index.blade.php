@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список новостей
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/news/create') }}"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Добавить новости</a>
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
                                <th>Картинка</th>
                                <th>Название</th>
                                <th>Краткое описание</th>
                                <th>Статус</th>
                                <th>Дата создание</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($news as $new) :?>
                            <tr>
                                <td>
                                    {{ $new->id }}
                                </td>
                                <td>
                                    @if(!empty($new->image) AND file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/news/'.$new->image))
                                        <img src="{{ asset('uploads/news/'.$new->image) }}" alt="" height="40" width="60" />
                                    @endif
                                </td>
                                <td>
                                    {{ $new->title }}
                                </td>
                                <td>
                                    {{ $new->description }}
                                </td>
                                <td>
                                    @if($new->publish == '0') В архиве @endif
                                    @if($new->publish == '1') Опубликован @endif
                                </td>
                                <td>
                                    {{ $new->created_at }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/news/'.$new->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                @if(check_admin_users_role(Auth::guard('admin')->user()->role))
                                    <td>
                                        <button onclick="delete_news({{ $new->id }});" class="btn btn-danger">Удалить</button>
                                    </td>
                                @endif
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $news->links() }}
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop