@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список ассортиментов
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="{{ url('admin/range/new') }}" class="btn btn-adn">Добавить ассортимент к основному прайсу</a>
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
                                <th>Дата публикации</th>
                                <th colspan="2">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($opt_range))
                            <?php foreach($opt_range as $opt) :?>
                            <tr>
                                <td>
                                    {{ $opt->id }}
                                </td>
                                <td class="avatar">
                                    <img src="{{ asset('uploads/opt_price/partners/small/'.getOptPartnerLogo($opt->id_partner)) }}" alt="" height="40" width="60" />
                                    {{ getOptPartnerData($opt->id_partner)->title }}
                                </td>
                                <td>
                                    {{ $opt->title }}
                                </td>
                                <td>
                                    {{ $opt->created_at }}
                                </td>
                                <td>
                                    <a href="{{ url('/admin/range/'.$opt->id) }}" class="btn btn-warning">Редактировать</a>
                                </td>
                                <td>
                                    <button onclick="delete_opt_price_range({{ $opt->id }});" class="btn btn-danger">Удалить</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            @endif
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