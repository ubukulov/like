@extends('partner.layout.partner')
@section('content')
    <div class="row" id="work">
        <div class="col-md-12">
            <h4>Список работы</h4>
            @if(Session::has('message'))
                <div class="alert alert-warning">
                    {!! Session::get('message') !!}
                </div>
            @endif
            <table class="table table-bordered">
                <th>Дата</th><th>Ссылка</th><th>Описание</th><th>Испольнитель</th><th>Статус</th><th colspan="3">Действие</th>
                @foreach($works as $work)
                    <tr>
                        <td>{{ $work->created_at }}</td>
                        <td>
                            @if(!empty($work->link_to_work))
                            <a href="{{ $work->link_to_work }}" rel="nofollow" target="_blank">Перейти</a>
                            @endif
                            @if(!empty($work->image))
                            <a href="{{ asset('uploads/tasks/works/'.$work->image) }}" target="_blank">Картинка</a>
                            @endif
                        </td>
                        <td><p>{!! $work->text !!}</p></td>
                        <td>{{ getUser($work->id_user) }}</td>
                        <td>
                            @if($work->status == 0)
                                Ожидает
                            @elseif($work->status == 1)
                                Одобрено
                            @else
                                Отменен
                            @endif
                        </td>
                        <td>
                            <button @if($work->status == 2 OR $work->status == 1) disabled="disabled" title="Работа уже закрыто"  @endif onclick="approve_btn({{ $work->id_task }},{{ $work->id }});" type="button" class="btn btn-success">@if($work->status == 2 OR $work->status == 1) Одобрено @else Одобрить @endif</button>
                        </td>
                        <td>
                            @if(getCountTaskCommit($work->id) > 0)
                                <a href="{{ url('partner/task/commits/'.$work->id) }}" class="btn btn-warning">Commits</a>
                            @else
                            <button @if($work->status == 2 OR $work->status == 1) disabled="disabled" title="Работа уже закрыто"  @endif  onclick="task_commit({{ $work->id }}, '{{ csrf_token() }}');" type="button" class="btn btn-warning">Commit</button>
                            @endif
                        </td>
                        <td><button @if($work->status == 2 OR $work->status == 1) disabled="disabled" title="Работа уже закрыто"  @endif onclick="task_close_work({{ $work->id }});" type="button" class="btn btn-danger">Отменить</button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{--<div class="ui modal" style="top:0px; height: 550px; width: 1000px;">--}}
        {{--<div class="content">--}}
            {{--<div class="row">--}}
                {{--<h2 class="green">Форма переписки</h2>--}}
                {{--<hr>--}}
                {{--<div class="col-md-12">--}}
                    {{--<input type="text" id="title" placeholder="Введите названия" class="form-control">--}}
                    {{--<br>--}}
                    {{--<textarea id="info_editor" cols="30" rows="10"></textarea>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<br>--}}
            {{--<hr>--}}
            {{--<button type="button" class="btn btn-success"><i class="send icon"></i>&nbsp;&nbsp; Комментировать и отправить</button>--}}
            {{--<button id="undoTask" type="button" class="btn btn-danger"><i class="remove small circle icon"></i>&nbsp;&nbsp;Закрыть окно</button>--}}
            {{--<div id="positive" class="hidden">--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop