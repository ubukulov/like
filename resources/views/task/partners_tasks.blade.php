@extends('layouts.task')
@section('content')
    <div class="row_tsk">
        @include('pattern.task_main_menu')
        <hr>
        <div class="row">
            @foreach ($tasks as $task)
                <div class="col-sm-3 col-xs-6">
                    <div class="brd">
                        <div class="portfolio-item">
                            <div class="portfolio-img" style="height: 140px;">
                                <img src="{{ asset('uploads/tasks/small/'.$task->image) }}" alt="port-1" class="port-item">
                                <div class="portfolio-img-hover">
                                    <a href="{{ url('/task/'.$task->id) }}">
                                        <img src="{{ asset('img/plus.png') }}" alt="plus" class="plus">
                                    </a>
                                </div>
                                <!-- /.portfolio-img-hover -->
                            </div>
                            <div class="portfolio-item-details">
                                <div class="portfolio-item-name"><?= $task->title; ?></div>
                                <!-- /.portfolio-item-name -->
                                <div style="float: left;">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                            <td style="width: 150px;line-height: 15px;">
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
                                                <a href="{{ url('/task/'.$task->id) }}" type="button" class="hidden-xs taskbutton">Подробнее</a>
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
    </div>
@stop