<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Likemoney.me</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('components/popup.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('components/menu.min.css') }}">--}}
    {{--        <link rel="stylesheet" href="{{ asset('components/dropdown.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('components/transition.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('components/icon.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('components/modal.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/partner.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
</head>
<body>
<div id="wrap">
    <div class="header">
        <nav id="mainNavigation" class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('home') }}"></a>
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
                            <a href="{{ url('user/account') }}">
                                <img class="my_avatar_small" @if(!empty(Auth::user()->avatar)) src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="user-photo">
                                &nbsp;
                                {{ Auth::user()->firstname }}
                            </a>
                            {{--<a style="color: #000; cursor: pointer;" data-toggle="modal" data-target="#loginModal">--}}
                            {{--<i class="fa fa-male"></i>&nbsp;&nbsp;ЛИЧНЫЙ КАБИНЕТ--}}
                            {{--</a>--}}
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- /.navbar-collapse -->
            </div>
        </nav><!-- /.nav -->

        <header class="page-head">
            <div class="header-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img class="my_avatar" align="right" @if(!empty(Auth::user()->avatar)) src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="user-photo">
                        </div>
                        <div class="col-md-9">
                            <font style="color:#FFF;"><h2>{{ Auth::user()->firstname." ".Auth::user()->lastname }}</h2><font style="font-size:20px;">
                                    Статус:
                                    <b>Мини-офис</b>
                                </font>&nbsp;<font color="#C63B3C"><i class="fa fa-question-circle"></i></font></font>
                            <br />
                            <a href="#" class="partner_link">Купить статус</a>

                            <p style="color: #fff;">
                                Баланс: <strong>@if(!empty(Auth::user()->fm)) {{ __decode(Auth::user()->fm,env('KEY')) }} @else 0 @endif тг.</strong> | В ожидании: <strong>{{ \App\User::count_user_balanse_v_ojidanii(Auth::user()->id) }} тг.</strong> | <a href="#" class="partner_link" data-toggle="modal" data-target="#userPaymentModal">пополнить</a>
                            </p>

                            <span style="position: absolute;"><a href="{{ url('user/balance/history') }}" class="partner_link">Посмотреть историю баланса</a></span>


                            {{--<div>--}}
                                {{--<div style="margin-top:70px; width: 1000px;">--}}
                                    {{--<ul class="nav nav-pills" style="margin-left: 0px;">--}}
                                        {{--<li @if(request_uri('account')) class="active" @endif>--}}
                                            {{--<a href="{{ url('user/account') }}">Личный кабинет</a>--}}
                                        {{--</li>--}}
                                        {{--<li @if(request_uri('task')) class="active" @endif>--}}
                                            {{--<a href="{{ url('user/task') }}">Task</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <div class="ui massive menu" style="font-size: 20px;border-radius: 0;border-bottom: 1px solid #fff;">
                                <a href="{{ url('user/account') }}" class="active item" style="background: none;">
                                    Личный кабинет
                                </a>
                                <div class="ui compact menu" style="font-size: 18px; border: none;box-shadow: none;">
                                    <div class="ui simple dropdown item">
                                        Task
                                        <i class="dropdown icon"></i>
                                        <div class="menu">
                                            <div class="item"><a href="{{ url('user/task') }}">Список ваших работ</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.header-wrapper -->
        </header>
        <!-- /.page-head -->
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <section class="blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <!-- begin twitter widget -->
                        <div style="line-height:2em;">
                            <h3>Информация</h3>


                            <i class="marker icon"></i>&nbsp;{{ getUserCity(Auth::user()->city) }}
                            <br />
                            <i class="call square icon"></i>&nbsp;{{ Auth::user()->mphone }}
                            <br />
                            <i class="mail outline icon"></i>&nbsp;{{ Auth::user()->email }}
                            <br />

                            <i class="wait icon"></i>&nbsp;{{ Auth::user()->birthday }}
                            <br />
                            <a class="partner_link" href="{{ url('user/setting') }}"><i class="configure icon"></i>&nbsp;Редактировать профиль</a>
                            <br />
                            <a class="partner_link" href="{{ url('user/logout') }}"><i class="sign out icon"></i>&nbsp;Выйти из кабинета</a>
                            <hr />
                            <a href="{{ asset('/files/Terms_of_use_Likemoney.me.pdf') }}" target="_blank">Пользовательское соглашение</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row_tsk">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    @include('pattern.footer')
</div>
</body>
{{--<script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>--}}
{{--<script src="{{ asset('lib/tinymce/config.js') }}"></script>--}}
<script src="{{ asset('lib/froala/js/froala_editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/froala/js/languages/ru.js') }}"></script>
<script src="{{ asset('js/ajaxupload.js') }}"></script>
<script src="{{ asset('js/upload_image.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>