<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Likemoney.me</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.1, maximum-scale=1.0, minimum-scale=0.25,  user-scalable=yes">
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/jquery_ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/flipclock/flipclock.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('components/popup.css') }}"></script>
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
                        <a href="/" rel="nofollow"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    @endif
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-4">
                        Прием заказов по WhatsApp <br>
                        <i class="fa fa-whatsapp">&nbsp; &nbsp; {{ $_SESSION['store_user_phone'] }}</i>
                    </div>
                    {{--<div class="col-sm-5">--}}
                        {{--<div class="ui action input">--}}
                            {{--<input type="text" style="width: 350px;">--}}
                            {{--<button class="ui button">Поиск</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-sm-5">
                        <div id="buy_div" style="display: none; padding: 15px; border-radius: 10px; width: 350px;" class="alert alert-success alert-dismissable">
                            <a style="right: -13px !important; top: -16px !important;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span id="buy_res"></span>
                        </div>
                    </div>

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
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <div class="row">
            <div class="col-md-3">
                <!-- begin twitter widget -->
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <span style="font-weight: bold;">Мы</span>&nbsp;&nbsp;<span style="font-family: Verdana, Arial, Helvetica, sans-serif;">гарантируем:</span>
                    </div>
                </div>

                <div class="row_tsk">
                    <div class="row" style="margin-bottom: 20px;">

                        <div class="col-md-2">
                            <img src="{{ asset('img/d_1.png') }}" alt="" align="left">
                        </div>

                        <div class="col-md-10">
                            <span style="font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;">Самая быстрая доставка по всему Казахстану</span>
                        </div>

                    </div>

                    <div class="row" style="margin-bottom: 20px;">

                        <div class="col-md-2">
                            <img src="{{ asset('img/d_2.png') }}" alt="" align="left">
                        </div>

                        <div class="col-md-10">
                            <span style="font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;">Оплата наличными в момент доставки или другим способом (банковские карты, QIWI терминал, безналичный платеж)</span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-2">
                            <img src="{{ asset('img/d_3.png') }}" alt="" align="left">
                        </div>

                        <div class="col-md-10" style="padding-top: 3px;">
                            <span style="font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;">14 дней на обмен и возврат</span>
                        </div>

                    </div>
                </div>

                @if(check_user_roles(Auth::id()) == 0)
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-12" style="text-align: center;">
                        <span>Данные о поставщиках</span>
                    </div>
                </div>
                <div class="row_tsk">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-2"><i class="briefcase icon large"></i></div>
                        <div class="col-md-10" style="padding-top: 9px;">
                            {{ $partner->name }}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-2"><i class="phone icon large"></i></div>
                        <div class="col-md-10" style="padding-top: 8px;">
                            {{ $partner->phone }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><i class="address card icon large"></i></div>
                        <div class="col-md-10" style="padding-top: 8px;">
                            {{ $partner->address }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="content section-wrapper" style="padding-top: 0px;">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    @include('pattern.footer')
</div>
</body>
<script src="{{ asset('lib/jquery_ui/jquery-ui.min.js') }}"></script>
{{--<script src="{{ asset('lib/tinymce/tinymce.min.js') }}"></script>--}}
<script src="{{ asset('lib/froala/js/froala_editor.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('lib/froala/js/languages/ru.js') }}"></script>--}}
{{--<script src="{{ asset('lib/tinymce/config.js') }}"></script>--}}
<script src="{{ asset('js/ajaxupload.js') }}"></script>
<script src="{{ asset('js/upload_image.js') }}"></script>
{{--<script src="{{ asset('lib/flipclock/flipclock.js') }}"></script>--}}
<script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('components/popup.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>--}}
{{--<script type="text/javascript">--}}
    {{--ymaps.ready(init);--}}
    {{--function init() {--}}
        {{--var myMap = new ymaps.Map("map", {--}}
                {{--center: [{{ $partner->coords }}],--}}
                {{--zoom: 14--}}
            {{--}),--}}
            {{--// Создаем метку с помощью вспомогательного класса.--}}
            {{--myPlacemark1 = new ymaps.Placemark([{{ $partner->coords }}], {--}}
                {{--// Свойства.--}}
                {{--// Содержимое иконки, балуна и хинта.--}}
                {{--iconContent: '',--}}
                {{--balloonContent: '{{ $partner->address }}',--}}
                {{--hintContent: '{{ $partner->name }}'--}}
            {{--}, {--}}
                {{--// Опции.--}}
                {{--// Стандартная фиолетовая иконка.--}}
                {{--preset: 'twirl#violetIcon'--}}
            {{--});--}}
        {{--// Добавляем все метки на карту.--}}
        {{--myMap.geoObjects--}}
            {{--.add(myPlacemark1);--}}
    {{--}--}}
{{--</script>--}}
</html>