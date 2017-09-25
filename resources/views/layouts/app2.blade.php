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
    <div class="header2">
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
                            <a href="index" style="color: #000 !important;">О НАС</a>
                        </li>
                        <li>
                            <a href="leading_2" style="color: #000 !important;">КОМПАНИЯМ</a>
                        </li>
                        <li class="">
                            <a href="leading_1" style="color: #000 !important;">ПОЛЬЗОВАТЕЛЯМ</a>
                        </li>

                        <li class="">
                            <a href="leading_1" style="color: #000 !important;">КОНТАКТЫ</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav><!-- /.nav -->
    </div>
    <!-- /.header -->

    <div id="content" class="ui container">
        <div class="content section-wrapper">
            <!-- /.section-title -->
            {{--<div class="task-menu" id="task-menu">--}}
                {{--<ul class="main_menu navbar-nav navbar-left">--}}
                    {{--<li class="active-task">--}}
                        {{--<a href="{{ route('home') }}" class="active">Offline cashback</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a class="link_a" href="#">--}}
                            {{--Online Cashback--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a class="link_a" href="#">--}}
                            {{--OptPrice--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                        {{--<a class="link_a" href="#">Магазин</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a class="link_a" href="{{ route('task') }}">Task</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a class="link_a" href="https://admotionz.com" rel="nofollow">Зарабатывай онлайн</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- /.nav -->--}}
            {{--</div>--}}

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