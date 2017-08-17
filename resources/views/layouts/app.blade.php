<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1, maximum-scale=1.0, minimum-scale=0.25,  user-scalable=yes">
    <title>Likemoney.me</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('components/popup.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('components/menu.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('components/dropdown.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('components/transition.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('components/icon.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('components/modal.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div id="wrap">
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
                    <a class="navbar-brand" href="{{ route('home') }}" rel="nofollow"></a>
                </div>
                <!-- /.navbar-header -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="active">
                            <a href="index">О НАС</a>
                        </li>
                        <li>
                            <a href="leading_2">КОМПАНИЯМ</a>
                        </li>
                        <li class="">
                            <a href="leading_1">ПОЛЬЗОВАТЕЛЯМ</a>
                        </li>
                        <li class="login_button">
                            {{--<a style="color: #fff; cursor: pointer;" data-toggle="modal" data-target="#loginModal">--}}
                                {{--<i class="fa fa-male"></i>&nbsp;&nbsp;ЛИЧНЫЙ КАБИНЕТ--}}
                            {{--</a>--}}
                            @if(Auth::check())
                                <?php if(isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) :?>
                                <a href="{{ url('/cart') }}" style="float: left; padding: 0px; top: -2px;"><img src="{{ asset('img/basket2.png') }}" alt=""> <?=$_SESSION['total_quantity']?> товар(-ов)</a>
                                <?php endif; ?>
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
                                <br>
                            @else
                                <a style="color: #fff; cursor: pointer;" href="{{ url('user/login') }}">
                                    <i class="fa fa-male"></i>&nbsp;&nbsp;ЛИЧНЫЙ КАБИНЕТ
                                </a>
                                <br>
                            @endif
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav><!-- /.nav -->

        <div class="container">
            <div class="header-table">
                <div class="header-wrapper">
                    <h1 class="header-title">Зарабатывать<br>с нами - легко!</h1>
                    <button type="button" class="main_button">Выполняй задания и зарабатывай</button>
                </div>
                <!-- /.header-wrapper -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <div class="content section-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <h2><small><font color="#62A005" size="5"><i class="fa fa-thumbs-up"></i></font>&nbsp; Выполнено заданий за сегодня: 0</small></h2>
                </div>

                <div class="col-md-6">
                    <h2><small><font color="#62A005" size="5"><i class="fa fa-credit-card-alt"></i></font>&nbsp; Заработали сегодня исполнители: 0 тг.</small></h2>
                </div>
            </div>

            <hr class="hidden-sm hidden-xs">
            <!-- /.section-title -->
            <div class="task-menu" id="task-menu">
                <ul class="main_menu navbar-nav navbar-left">
                    <li class="active-task">
                        <a href="{{ route('home') }}" class="active">Offline cashback</a>
                    </li>
                    <li>
                        <a class="link_a" href="#">
                            Online Cashback
                        </a>
                    </li>
                    <li>
                        <a class="link_a" href="#">
                            OptPrice
                        </a>
                    </li>

                    <li>
                        <a class="link_a" href="#">Магазин</a>
                    </li>
                    <li>
                        <a class="link_a" href="{{ route('task') }}">Task</a>
                    </li>
                    <li>
                        <a class="link_a" href="https://admotionz.com" rel="nofollow">Зарабатывай онлайн</a>
                    </li>
                </ul>
                <!-- /.nav -->
            </div>

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