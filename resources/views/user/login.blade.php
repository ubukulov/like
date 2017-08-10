@extends('user.layout.form')
@section('content')
<div class="login-box-body">
    <p class="login-box-msg">Форма авторизации пользователя</p>
    @if(Session::has('message'))
        <div class="alert alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('message') !!}
        </div>
    @endif
    <form action="{{ url('/user/login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <input type="text" id="username" name="username" class="form-control" placeholder="Телефон" required="required">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required="required">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Запомнить меня
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{--<div class="social-auth-links text-center">--}}
    {{--<p>- OR -</p>--}}
    {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
    {{--Facebook</a>--}}
    {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
    {{--Google+</a>--}}
    {{--</div>--}}
    {{--<!-- /.social-auth-links -->--}}

    <a href="{{ url('user/password/reset') }}">Забыли пароль?</a><br>
    <a href="{{ url('user/register') }}" class="text-center">Регистрация</a>

</div>
<!-- /.login-box-body -->
@stop