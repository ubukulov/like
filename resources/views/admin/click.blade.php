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
                                <th>Телефон</th>
                                <th>Интерес</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Дата заявки</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($clicks as $item) :?>
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td>
                                    @if(!empty($item->image) AND file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/certs/'.$item->image))
                                        <a target="_blank" href="{{ url('/item/'.$item->id_item) }}"><img src="{{ asset('uploads/certs/'.$item->image) }}" alt="" height="40" width="60" />{{ rtrim($item->title) }}</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->special2 }} тг.
                                </td>
                                <td>
                                    @if($item->status == '0') Открыто @endif
                                    @if($item->status == '1') Закрыто @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <button type="button" @if($item->status == '1') title="Уже закрыто" disabled="disabled" @endif onclick="close_buy_1_click({{ $item->id }});" class="btn btn-warning">Закрыть</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        {{ $clicks->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop