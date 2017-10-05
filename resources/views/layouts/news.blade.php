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
                    <li class="#"><a href="{{ url('/news') }}">Новости</a></li>
                    <li class="#"><a href="#">Все о нас</a></li>
                    <li class="#"><a href="#">Партнерам</a></li>
                </nav>
            </div>
            <div class="col-sm-4 text-right nopad">
                <span class="kabinet">
                    @if(Auth::check())
                        <a style="color: #fff; cursor: pointer; float: left;" href="{{ url('user/account') }}">
                                    @if (!empty(Auth::user()->avatar))
                                <img class="my_avatar_small" src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" alt="user-photo">
                            @else
                                <img class="my_avatar_small" src="{{ asset('img/blank_avatar_220.png') }}" alt="user-photo">
                            @endif
                            &nbsp;
                            {{ Auth::user()->firstname }}
                            &nbsp;
                                    <font color="#619F05">{{ __decode(Auth::user()->fm, env('KEY')) }} тг</font>
                                </a>
                    @else
                        <i class="user icon"></i>
                        <a style="color: #ffffff; text-decoration: none;" href="{{ url('user/login') }}">Личный кабинет</a>
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" rel="nofollow"></a>
                </div>
                <!-- /.navbar-header -->
                <div class="collapse navbar-collapse">
                    <div class="col-sm-8" style="font-size: 12px; padding-top: 20px;">
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
                    <?php if(isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) :?>
                    <div class="col-sm-2" style="padding-top: 10px; float: right;">
                        <a href="{{ url('cart') }}">
                            <span class="korsina">
                            Корзина <img src="{{ asset('img/shopping-cart.png') }}" alt="cart">
                            <sup><?=$_SESSION['total_quantity']?></sup>
                        </span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav><!-- /.nav -->

        <div class="container">
            <div class="header-table">
                <div class="header-wrapper">
                    <h1 class="header-title">Зарабатывать<br>с нами - легко!</h1>
                    <button type="button" class="main_button">Хочу интернет магазин - бесплатно!</button>
                </div>
                <!-- /.header-wrapper -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <div class="content section-wrapper">

            @yield('content')
        </div>
    </div>
    <!-- /.content -->
    <section class="note purple">
        <div class="container section-wrapper text-center">
            <button class="footerbutton">Начать выполнять задания</button>
            <!-- /.quote -->
            <div class="quoter">... и заработать уже сегодня</div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /.note -->
    @include('pattern.footer')
</div>
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/semantic.min.js') }}"></script>
{{--<script src="{{ asset('components/popup.min.js') }}"></script>--}}
{{--<script src="{{ asset('components/modal.min.js') }}"></script>--}}
{{--<script src="{{ asset('components/dropdown.min.js') }}"></script>--}}
{{--<script src="{{ asset('components/transition.min.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
</html>