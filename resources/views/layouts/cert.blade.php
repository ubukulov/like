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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/froala/css/froala_editor.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('lib/froala/css/froala_editor.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('lib/jquery_ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/flipclock/flipclock.css') }}">
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
                            @if(Auth::check())
                                <a style="color: #000; cursor: pointer;" href="{{ url('user/account') }}">
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
                                <a style="color: #000; cursor: pointer;" href="{{ url('user/login') }}">
                                    <i class="fa fa-male"></i>&nbsp;&nbsp;ЛИЧНЫЙ КАБИНЕТ
                                </a>
                                <br>
                            @endif
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
                            <img class="my_avatar" align="right" @if(!empty($partner->image)) src="{{ asset('uploads/partners/small/'.$partner->image) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="user-photo">
                        </div>
                        <div class="col-md-9">
                            <br>
                            <font style="color:#FFF;"><h2>{{ $partner->name }}</h2><font style="font-size:20px;">
                                    Статус:
                                    <b>Компания - партнер</b>
                                </font>&nbsp;<font color="#C63B3C"><i class="fa fa-question-circle"></i></font></font>
                            <br />
                            <br />


                            <div>
                                <div style="margin-top:70px; width: 1000px;">
                                    <ul class="nav nav-pills" style="margin-left: 0px;">
                                        <li>
                                            <a href="#"><i class="fa fa-angle-left fa-2"></i>&nbsp;&nbsp;&nbsp;Все задания партнера</a>
                                        </li>
                                    </ul>
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


                            <i class="marker icon"></i>&nbsp;{{ $partner->address }}
                            <br />
                            <i class="call square icon"></i>&nbsp;{{ $partner->phone }}
                            <br />
                            <i class="mail outline icon"></i>&nbsp;{{ $partner->email }}
                            <br />

                            <i class="wait icon"></i>&nbsp;{{ $partner->hours }}
                            <br />
                        </div>
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

    </div>

    @include('pattern.footer')
</div>
</body>
<script src="{{ asset('lib/jquery_ui/jquery-ui.min.js') }}"></script>
{{--<script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>--}}
<script src="{{ asset('lib/froala/js/froala_editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/froala/js/languages/ru.js') }}"></script>
{{--<script src="{{ asset('lib/tinymce/config.js') }}"></script>--}}
<script src="{{ asset('js/ajaxupload.js') }}"></script>
<script src="{{ asset('js/upload_image.js') }}"></script>
<script src="{{ asset('lib/flipclock/flipclock.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init() {
        var myMap = new ymaps.Map("map", {
            center: [{{ $partner->coords }}],
            zoom: 14
        }),
        // Создаем метку с помощью вспомогательного класса.
        myPlacemark1 = new ymaps.Placemark([{{ $partner->coords }}], {
            // Свойства.
            // Содержимое иконки, балуна и хинта.
            iconContent: '',
            balloonContent: '{{ $partner->address }}',
            hintContent: '{{ $partner->name }}'
        }, {
            // Опции.
            // Стандартная фиолетовая иконка.
            preset: 'twirl#violetIcon'
        });
        // Добавляем все метки на карту.
        myMap.geoObjects
        .add(myPlacemark1);
    }
</script>
</html>