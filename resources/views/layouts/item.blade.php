<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Likemoney.me</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.1, maximum-scale=1.0, minimum-scale=0.25,  user-scalable=yes">
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
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
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $.fn.bsModal = $.fn.modal.noConflict();
    </script>
    <script type="text/javascript">
        $("#button_semantic").on("click", function(){
            $("#modal_semantic").modal("show");
        });
        $("#button_bootstrap").on("click", function(){
            $("#modal_bootstrap").bsModal("show");
        });
    </script>
</head>
<body>
<div id="wrap">
    @include('pattern.top_menu')
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
                    @if(check_user_store_img(Auth::id()))
                        <a href="/" rel="nofollow"><img src="{{ asset('uploads/users/store/'.check_user_store_img(Auth::id())) }}" alt=""></a>
                    @else
                        <a href="/" rel="nofollow"><img src="{{ asset('img/opt_price_logo_red.png') }}" alt=""></a>
                    @endif
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-4">
                        Прием заказов по WhatsApp <br>
                        <i class="fa fa-whatsapp">&nbsp; &nbsp; +7(777) 447-77-04</i>
                    </div>
                    {{--<div class="col-sm-5">--}}
                        {{--<div class="ui action input">--}}
                            {{--<input type="text" style="width: 350px;">--}}
                            {{--<button class="ui button">Поиск</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="col-sm-1">
                    <a href="{{ url('/cart') }}">
                    <span class="korsina">
                    Корзина <img src="{{ asset('img/shopping-cart.png') }}" alt="cart">
                    @if(isset($_SESSION['total_quantity']))
                        <sup id="sup">{{ $_SESSION['total_quantity'] }}</sup>
                    @else
                        <sup id="sup">0</sup>
                    @endif
                    </span>
                    </a>
                </div>
            </div>
        </nav><!-- /.nav -->

        {{--<header class="page-head">--}}
            {{--<div class="header-wrapper">--}}
                {{--<div class="container">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-3">--}}
                            {{--<img class="my_avatar" align="right" @if(!empty($partner->image)) src="{{ asset('uploads/partners/small/'.$partner->image) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="user-photo">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<br>--}}
                            {{--<font style="color:#FFF;"><h2>{{ $partner->name }}</h2><font style="font-size:20px;">--}}
                                    {{--Статус:--}}
                                    {{--<b>Компания - партнер</b>--}}
                                {{--</font>&nbsp;<font color="#C63B3C"><i class="fa fa-question-circle"></i></font></font>--}}
                            {{--<br />--}}
                            {{--<br />--}}


                            {{--<div>--}}
                                {{--<div style="margin-top:70px; width: 1000px;">--}}
                                    {{--<ul class="nav nav-pills" style="margin-left: 0px;">--}}
                                        {{--<li>--}}
                                            {{--<a href="#"><i class="fa fa-angle-left fa-2"></i>&nbsp;&nbsp;&nbsp;Все задания партнера</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.container -->--}}
            {{--</div>--}}
            {{--<!-- /.header-wrapper -->--}}
        {{--</header>--}}
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