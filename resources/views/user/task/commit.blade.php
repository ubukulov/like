@extends('user/layout/user')
@section('content')
    <h3 style="text-align: center;">Тема: {{ $work->title }}</h3>
    @if(Session::has('message'))
    <div class="alert alert-warning">
        {!! Session::get('message') !!}
    </div>
    @endif
    <div class="ui huge comments">
    @foreach($commits as $commit)
        @if($commit->avtor == 0)
        <div class="comment" style="width: 930px; height: 120px;">
            <a class="avatar">
                <img @if(!empty($commit->partner_image)) src="{{ asset('uploads/partners/small/'.$commit->partner_image) }}"  @else src="{{ asset('img/blank_avatar_80.png') }}" @endif style="width: 100px !important; height: 120px;">
            </a>
            <div class="content" style="margin-left: 115px !important;">
                <a class="author">{{ $commit->partner_name }}</a>
                <div class="metadata">
                    <div class="date">{{ $commit->created }}</div>
                </div>
                <div class="text">
                    <p>{!! $commit->text !!}</p>
                </div>
                <div class="actions">
                    @if(!empty($commit->link))
                        <i class="linkify icon"></i>&nbsp;&nbsp;<a href="{{ $commit->link }}" rel="nofollow" target="_blank">Ссылка</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif
                    @if(!empty($commit->image))
                        <i class="image icon"></i>&nbsp;&nbsp;<a href="{{ asset('uploads/tasks/commit/'.$commit->image) }}" target="_blank">Ссылка</a>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="comment" style="width: 930px; height: 120px;">
            <a class="avatar">
                <img @if(!empty(Auth::user()->avatar)) src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}"  @else src="{{ asset('img/blank_avatar_80.png') }}" @endif style="width: 100px !important; height: 120px;">
            </a>
            <div class="content" style="margin-left: 115px !important;">
                <a class="author">Вы</a>
                <div class="metadata">
                    <div class="date">{{ $commit->created }}</div>
                </div>
                <div class="text">
                    <p>{!! $commit->text !!}</p>
                </div>
                <div class="actions">
                    @if(!empty($commit->link))
                        <i class="linkify icon"></i>&nbsp;&nbsp;<a href="{{ $commit->link }}" rel="nofollow" target="_blank">Ссылка</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif
                    @if(!empty($commit->image))
                        <i class="image icon"></i>&nbsp;&nbsp;<a href="{{ asset('uploads/tasks/commit/'.$commit->image) }}" target="_blank">Ссылка</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
        <br><br>
        <form class="ui huge reply form" method="post" action="{{ url('user/task/send_commit/'.$work->id) }}">
            {{ csrf_field() }}
            <div class="field">
                <textarea name="text" cols="30" rows="10" required="required"></textarea>
            </div>
            <div class="two fields">
                <div class="field">
                    <div class="ui labeled input">
                        <div class="ui label">
                            Ссылка
                        </div>
                        <input type="text" placeholder="mysite.com" name="link">
                    </div>
                </div>

                <div class="field">
                    <div class="ui small image">
                        <div id="image1">
                            <img src="{{ asset('img/image.png') }}">
                        </div>
                        <br>
                        <button type="button" id="upload1" class="ui large button">Выбрать картинку</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="ui huge primary submit labeled icon button" style="width: 250px;"><i class="icon edit"></i> Добавить комментарии</button>
        </form>
    </div>
@stop