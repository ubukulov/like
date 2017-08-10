@extends('layouts.task')
@section('content')
    <div class="row_tsk">
        @include('pattern.task_main_menu')
        <hr>
        <div class="row">
            @foreach ($partners as $partner)
                <div class="col-sm-3 col-xs-6">
                    <div class="brd">
                        <div class="portfolio-item">
                            <a href="{{ url('task/filter/partners/'.$partner->id) }}">
                            <div class="portfolio-img" style="height: 140px;">
                                <img @if(!empty($partner->image)) src="{{ asset('uploads/partners/small/'.$partner->image) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="port-1" class="port-item">
                                <div class="portfolio-img-hover">
                                </div>
                                <!-- /.portfolio-img-hover -->
                            </div>
                            </a>
                            <div class="portfolio-item-details">
                                <div class="portfolio-item-name">{{ $partner->name }}</div>
                                <!-- /.portfolio-item-name -->
                                <div style="float: left;">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td align="center"><font color="#62A005" size="4"></font></td>
                                            <td style="width: 150px;line-height: 15px;">
                                                <small>Заданий:&nbsp;&nbsp;{{ $partner->count_task }}</small><br>
                                                <small>Выполнено:&nbsp;&nbsp;{{ $partner->count_work }}</small>
                                            </td>
                                            <td style="padding-left:15px;" align="center">
                                                <a href="{{ url('task/filter/partners/'.$partner->id) }}" type="button" class="hidden-xs taskbutton">Подробнее</a>
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