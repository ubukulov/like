@extends('user/layout/user')
@section('content')
    <h4>Список ваших работы</h4>
    <div class="row">
        <div class="col-md-12">
            @foreach($works as $work)
            <div class="row" style="border-bottom: 1px solid #cccccc; padding-bottom: 5px; margin-top: 8px;">
                <div class="col-md-1" style="margin-right: 30px;">
                    <img @if(!empty($work->image)) width="100" src="{{ asset('uploads/tasks/small/'.$work->image) }}"  @else src="{{ asset('img/blank_avatar_80.png') }}" @endif alt="">
                </div>
                <div class="col-md-10">
                    <h4>Названия задания: {{ $work->task_title }}</h4>
                    <p style="font-size: 12px;">{!! $work->text !!}</p>
                    <div class="row">
                        <div class="col-md-3">
                            <span><i>Статус: </i>@if($work->status == 0) Ожидает @endif @if($work->status == 1) Одобрено @endif @if($work->status == 2) Отменен @endif </span>
                        </div>
                        <div class="col-md-3">
                            <span><i>Рейтинг: </i>@if($work->rating == 1) Класс @endif @if($work->rating == 2) Хорошо @endif @if($work->rating == 3) Нормально @endif </span>
                        </div>
                        <div class="col-md-3">
                            <span><i>Commit: </i><a href="{{ url('user/task/commits/'.$work->id) }}">{{ getCountTaskCommit($work->id) }} @if(getCountTaskCommitNew($work->id) > 0) (новые {{ getCountTaskCommitNew($work->id) }}) @endif</a></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop