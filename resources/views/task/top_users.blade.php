@extends('layouts.task')
@section('content')
    <div class="row_tsk">
        @include('pattern.task_main_menu')
        <hr>
        <div class="row">
            @foreach ($top_users as $top_user)
                <div class="col-sm-3 col-xs-6">
                    <div class="brd">
                        <div class="portfolio-item">
                            <div class="portfolio-img" style="height: 140px;">
                                <img @if(!empty($top_user->avatar)) src="{{ asset('uploads/users/small/'.$top_user->avatar) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="port-1" class="port-item">
                                <div class="portfolio-img-hover">
                                </div>
                                <!-- /.portfolio-img-hover -->
                            </div>
                            <div class="portfolio-item-details">
                                <div class="portfolio-item-name">{{ $top_user->firstname." ".$top_user->lastname }}</div>
                                <!-- /.portfolio-item-name -->
                                <div style="float: left;">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td align="center"><font color="#62A005" size="4"></font></td>
                                            <td style="width: 150px;line-height: 15px;">
                                                <small>Выполнил:&nbsp;&nbsp;{{ $top_user->count_done_task }}</small><br>
                                                <small>Рейтинг :&nbsp;&nbsp;{{ $top_user->rating }}</small>
                                            </td>
                                            <td style="padding-left:15px;" align="center">
                                                <a href="#" type="button" class="hidden-xs taskbutton">Подробнее</a>
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