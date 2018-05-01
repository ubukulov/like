@extends('user.layout.form')
@section('content')
    <div class="register-box-body">
        <p class="login-box-msg">Форма регистрации пользователя</p>
        @if(Session::has('message'))
            <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! Session::get('message') !!}
            </div>
        @endif
        <form action="{{ url('user/register') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="firstname" required="required" placeholder="Введите ваше имя">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="lastname" required="required" placeholder="Введите ваше фамилия">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="Введите email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="username" name="username" required="required" placeholder="Введите номер мобильного телефона">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="promocode" placeholder="Введите промокод, если есть">
                <span class="fa fa-user-plus form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" value="1" checked="checked"> Принимаю условия <a href="{{ asset('files/Terms_of_use_Likemoney.me.pdf') }}" target="_blank">соглашения</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Зарегистрироваться</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{--<div class="social-auth-links text-center">--}}
            {{--<p>- OR -</p>--}}
            {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using--}}
                {{--Facebook</a>--}}
            {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using--}}
                {{--Google+</a>--}}
        {{--</div>--}}
        <br>
        <a href="{{ url('user/login') }}" class="text-center">У меня уже есть аккаунт</a>
    </div>
    <!-- /.form-box -->
@stop