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
                    <div class="col-sm-5">
                        <div class="ui action input">
                            <input type="text" style="width: 350px;">
                            <button class="ui button">Поиск</button>
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
            <div class="col-sm-3">
                <a href="#"><img src="{{ asset('img/st1.jpeg') }}" alt=""></a>
            </div>
            <div class="col-sm-3">
                <a href="#"><img src="{{ asset('img/st2.jpg') }}" alt=""></a>
            </div>
            <div class="col-sm-6">
                <a href="#"><img src="{{ asset('img/st3.jpg') }}" alt=""></a>
            </div>
        </div>
        <div class="content section-wrapper" style="padding-top: 0px;">
            @yield('content')
        </div>
    </div>
    <!-- /.content -->
    {{--<section class="note purple">--}}
        {{--<div class="container section-wrapper text-center">--}}
            {{--<button class="footerbutton">Начать выполнять задания</button>--}}
            {{--<!-- /.quote -->--}}
            {{--<div class="quoter">... и заработать уже сегодня</div>--}}
        {{--</div>--}}
        {{--<!-- /.container -->--}}
    {{--</section>--}}
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