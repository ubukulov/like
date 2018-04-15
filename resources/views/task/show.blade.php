@extends('layouts.cert')
@section('content')
    <div class="row_tsk">
        <div class="blog-heading">
            <h3><?= $task[0]->title; ?></h3>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                @if(!empty($task[0]->image))
                    <img src="{{ asset('uploads/tasks/'.$task[0]->image) }}" width="400" alt="">
                @else
                    <img src="{{ asset('img/no_thumb.png') }}" width="400" alt="">
                @endif
            </div>

            <div class="col-md-6">
                <div class="row">
                    <i class="money green big icon"></i>&nbsp;&nbsp;Оплата:
                    @if(!empty($task[0]->is_amount) AND (!empty($task[0]->is_gift)))
                        <font color="#62A005" style="font-size: 11px;"><b>Денгами и подарками</b></font>
                    @elseif(!empty($task[0]->is_amount))
                        <font color="#62A005"><b>до {{ $task[0]->is_amount }} тг</b></font>
                    @elseif(!empty($task[0]->is_gift))
                        <font color="#62A005"><b>Подарками</b></font>
                    @endif
                </div>

                <div class="row" style="margin-top: 20px;">
                    <i class="linkify green big icon"></i>&nbsp;&nbsp;<a href="{{ $task[0]->related_works }}" target="_blank" rel="nofollow">Просмотр похожые работы</a>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <button @if(!Auth::check()) onclick="redirect_to_user_login_form();" title="Нужно авторизоваться как испольнитель" @else id="doneTask" @endif type="button" class="btn btn-success"><i class="play icon"></i>&nbsp;&nbsp;Выполнить сейчас</button>
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p>{!! $task[0]->text !!}</p>
            </div>
        </div>

        <div class="ui modal" style="top:0px; height: 750px;">
            <div class="content">
                <div class="form-group">
                    <h2 class="green">Форма отправление работы</h2>
                    {{ csrf_field() }}
                    <input type="hidden" id="id_task" value="{{ $task[0]->id }}">
                    <hr>
                    <div class="ui big labeled input">
                        <div class="ui big orange label">
                            Названия работы
                        </div>
                        <input type="text" name="title" id="title" style="width: 735px;" placeholder="не обязательно для заполнения">
                    </div>
                    <br><br>
                    <textarea name="text" id="info_editor" cols="30" rows="4"></textarea>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ui big labeled input">
                                <div class="ui big blue label">
                                    Ссылка на работу
                                </div>
                                <input type="text" name="link_to_work" id="link_to_work" style="width: 300px;" placeholder="mysite.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="image1">
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать картинку 1</button>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <br>
                    <hr>
                    <button id="sendTask" class="btn btn-success" type="button"><i class="send large icon"></i>&nbsp;&nbsp;Отправить задания</button>
                    <button id="undoTask" class="btn btn-danger" type="button"><i class="undo large icon"></i>&nbsp;&nbsp;Отменить или закрыть окно</button>
                </div>
                <div id="positive" class="hidden">

                </div>
            </div>
        </div>
    </div>
@stop