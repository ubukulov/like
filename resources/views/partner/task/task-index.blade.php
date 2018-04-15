@extends('partner.layout.partner')
@section('content')
    <a href="{{ url('partner/task/create') }}" class="btn btn-danger">Создать задание</a>
    <br><br>
    <div class="blog-heading">
        <h3>Список ваших задании</h3>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!!Session::get('message')!!}
        </div>
    @endif

    <hr />
    <table width="100%">
        <tr>
            <td><font style="color:#0099CC"><i class="fa fa-users"></i></font>&nbsp;&nbsp;Исполнители: {{ getCountDoneWorkPartner(Auth::guard('partner')->user()->id) }}</td>
            <td><font style="color:#619F05"><i class="fa fa-thumbs-up"></i></font>&nbsp;&nbsp;Выполнено работы: {{ getCountDoneWorkPartner(Auth::guard('partner')->user()->id) }}</td>
            <td>Всего заданий: {{ count($tasks) }}</td>
        </tr>
    </table>
    <hr />

    <div class="row">

        @foreach ($tasks as $task)
        <div class="col-sm-3 col-xs-6">
            <div class="brd">
                <div class="portfolio-item">
                    <!-- /.portfolio-img -->
                    <a href="{{ url('/task/'.$task->id) }}" target="_blank">
                    <div class="portfolio-img" style="height: 140px;">
                        <img src="{{ asset('uploads/tasks/small/'.$task->image) }}" alt="port-1" class="port-item">
                        <div class="portfolio-img-hover">
                        </div>
                        <!-- /.portfolio-img-hover -->
                    </div>
                    </a>
                    <div class="portfolio-item-details">
                        <div class="portfolio-item-name"><?= $task->title; ?></div>
                        <!-- /.portfolio-item-name -->
                        <div style="float: left;">
                            <table>
                                <tbody>
                                <tr>
                                    <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                    <td style="padding-left:7px; line-height: 15px;">
                                        <small>Оплата:<br>
                                            @if(!empty($task->is_amount) AND (!empty($task->is_gift)))
                                                <font color="#62A005" style="font-size: 11px;"><b>Денгами и подарками</b></font>
                                            @elseif(!empty($task->is_amount))
                                                <font color="#62A005"><b>до {{ $task->is_amount }} тг</b></font>
                                            @elseif(!empty($task->is_gift))
                                                <font color="#62A005"><b>Подарками</b></font>
                                            @endif
                                        </small>
                                    </td>
                                    <td style="padding-left:15px;" align="center">
                                        <a href="{{ url('/task/'.$task->id) }}" target="_blank" type="button" class="hidden-xs taskbutton">Подробнее</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.portfolio-item-details -->
                </div>
            </div>
            <!-- /.portfolio-item -->
        </div>

        @endforeach

    </div>
    <hr />
@stop