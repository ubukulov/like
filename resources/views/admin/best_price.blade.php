@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список BestPrice
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
                                <th>Название товара</th>
                                <th>Цена</th>
                                <th>Поставщик</th>
                                <th>Телефон</th>
                                <th>Адрес</th>
                                <th>Email</th>
                                <th>Дата создание</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($best_prices as $key=>$best) :?>
                            <tr>
                                <td>
                                    {{ $best->id }}
                                </td>
                                <td>
                                    {{ $best->title }}
                                </td>
                                <td>
                                    {{ $best->min_price }}
                                </td>
                                <td>
                                    {{ $best->com_title }}
                                </td>
                                <td>
                                    {{ $best->mphone }}
                                </td>

                                <td>
                                    {{ $best->address }}
                                </td>

                                <td>
                                    {{ $best->email }}
                                </td>

                                <td>
                                    {{ $best->created_at }}
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
    </section>
@stop