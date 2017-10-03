<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1, maximum-scale=1.0, minimum-scale=0.25,  user-scalable=yes">
    <title>Likemoney.me</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div id="wrap">
    <div class="top-header">
        <div class="container">
            <div class="col-sm-8 nopad">
                <nav class="top_menu">
                    <li class="main-li"><a href="/">Главная</a></li>
                    <li class="#"><a href="#">Новости</a></li>
                    <li class="#"><a href="#">Все о нас</a></li>
                    <li class="#"><a href="#">Партнерам</a></li>
                    <li class="#"><a href="#">+ Предложить свой товар</a></li>
                </nav>
            </div>
            <div class="col-sm-4 text-right nopad">
                <span class="kabinet">
                    <i class="user icon"></i>
                    <a style="color: #ffffff; text-decoration: none;" href="{{ url('user/login') }}">Личный кабинет</a>
                </span>
            </div>
        </div>
    </div>
    <div class="header2">
        <nav class="navbar navbar-default">
            <div class="container cont">
                <div class="col-sm-2">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" rel="nofollow"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-4">
                        Прием заказов по WhatsApp <br>
                        <i class="fa fa-whatsapp">&nbsp; &nbsp; +7(777) 447-77-04</i>
                    </div>
                    <div class="col-sm-5">
                        <div class="ui action input">
                            <input type="text" style="width: 350px;">
                            <button class="ui button">Поиск</button>
                        </div>
                    </div>
                </div>
                @if(isset($_SESSION['total_quantity']))
                <div class="col-sm-1">
                    <span class="korsina">
                        Корзина <img src="{{ asset('img/shopping-cart.png') }}" alt="cart">
                        <sup>{{ $_SESSION['total_quantity'] }}</sup>
                    </span>
                </div>
                @endif
            </div>
        </nav><!-- /.nav -->
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <div class="content section-wrapper" style="padding-top: 0px;">
            @yield('content')
        </div>
    </div>
    @include('pattern.footer')
</div>
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/semantic.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>