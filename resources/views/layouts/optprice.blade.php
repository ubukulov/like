<html>
<head>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="description" content="Зарабатывать с нами - легко!">
    <meta name='B-verify' content='14e5fe9055dc191ce5cb7c8dfe70ace82b9383bd' />
    <meta name="verify-admitad" content="bcfc76fe10" />
    <!-- meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap_main_page.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/one-page.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyles.css') }}">

    <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- RedHelper -->
    <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" src="https://web.redhelper.ru/service/main.js?c=likemoneyworld"></script>
    <!-- /RedHelper -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-90549256-1', 'auto');
        ga('send', 'pageview');

    </script>

</head>
<body class="">
<!-- Home -->
<section class="header headersmall smallest" id="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-optprice" href="{{ url('/optprice') }}"></a>
            </div>
            <!-- /.navbar-header -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="index">О НАС</a>
                    </li>
                    <li>
                        <a href="leading_2">КОМПАНИЯМ</a>
                    </li>
                    <li class="">
                        <a href="leading_1">ПОЛЬЗОВАТЕЛЯМ</a>
                    </li>
                </ul>
                <div class="loginbutton loginbutton768">

                    @if(Auth::check())
                        <a style="color: #fff; cursor: pointer;" href="{{ url('user/account') }}">
                            @if (!empty(Auth::user()->avatar))
                                <img class="my_avatar_small" src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" alt="user-photo">
                            @else
                                <img class="my_avatar_small" src="{{ asset('img/blank_avatar_220.png') }}" alt="user-photo">
                            @endif
                            &nbsp;
                            {{ Auth::user()->firstname }}
                            &nbsp;
                            <font color="#619F05">{{ __decode(Auth::user()->fm,env('KEY')) }} тг</font>
                        </a>
                        <br>
                    @else
                        <a style="color: #fff; cursor: pointer;" data-toggle="modal" data-target="#loginModal">
                            <i class="fa fa-male"></i>&nbsp;&nbsp;ЛИЧНЫЙ КАБИНЕТ
                        </a>
                        <br>
                        @endif
                        </button>
                        <!-- /.nav -->
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
    </nav>
    <div class="container">
        <div class="header-table">
            <div class="header-wrapper">
                <h1 class="header-title-optprice">Покупай любую продукцию<br>по оптовой цене от 1шт.</h1>
                <button onclick="location='leading_1'" type="button" class="mainbutton smallbutton">Подробнее</button>
            </div>
            <!-- /.header-wrapper -->
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /#header -->

@include('pattern/__modal_auth')

<!-- Portfolio -->
<section id="vsego_zadanii" class="portfolio" id="portfolio">
    <div class="container section-wrapper">
        <h2><!--Всего заданий: 2<small class="hidden-sm hidden-xs">--><font color="#62A005" size="5"><i class="fa fa-thumbs-up"></i></font>&nbsp; Всего участников:  &nbsp; &nbsp; &nbsp; &nbsp;<font color="#62A005" size="5" style="margin-left: 200px;"><i class="fa fa-credit-card-alt"></i></font>&nbsp; Общее количество покупок:  </small></h2>
        <hr class="hidden-sm hidden-xs">
        <!-- /.section-title -->
        <div class="task-menu" id="task-menu">
            @include('pattern/main_menu')
        </div>
        <div class="rowtsk">
            @yield('content')
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.portfolio -->

@include('pattern/note')

@include('pattern/footer')

</body>
</html>