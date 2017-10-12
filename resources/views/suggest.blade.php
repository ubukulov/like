@extends('layouts.news')
@section('content')
    <div class="row_tsk news" style="padding-left: 50px;">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!!Session::get('message')!!}
            </div>
        @endif
        <form action="{{ url('/suggest') }}" method="post" class="form-horizontal" style="width: 700px;">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" name="phone" id="phone" class="form-control" required="required" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="suggest">Предложение</label>
                    <textarea name="suggest" id="suggest" cols="30" rows="10" class="form-control" required="required">{{ old('suggest') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="captcha">Капча: </label>
                    15 + 28 =
                    <input type="text" name="captcha" id="captcha" class="form-control" required="required">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Отправить</button>
                </div>
            </div>
        </form>
    </div>
@stop