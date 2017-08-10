@extends('user.layout.form')
@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Форма сброса пароля пользователя</p>
        @if(Session::has('message'))
            <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('message') !!}
            </div>
        @endif
        <form action="{{ url('/user/password/reset') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="Введите телефон" required="required">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Сбросить пароль от личного кабинета</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <br><br>
        <a href="{{ url('user/login') }}" class="text-center">&laquo; Вернуться в форму авторизация</a>

    </div>
    <!-- /.login-box-body -->
@stop