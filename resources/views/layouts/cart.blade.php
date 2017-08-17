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
    <link rel="stylesheet" href="{{ asset('lib/jquery_ui/jquery-ui.min.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
<div id="wrap">
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
                            <?php if(isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) :?>
                            <a href="{{ url('/cart') }}" style="float: left; padding: 0px; top: -2px;"><img src="{{ asset('img/basket2.png') }}" alt=""> <?=$_SESSION['total_quantity']?> товар(-ов) в корзине</a>
                            <?php endif; ?>
                            <a style="color: #000; cursor: pointer; float: left;" href="{{ url('user/account') }}">
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
    <!-- /.header -->

    <div id="content" class="ui container">
        <section class="blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</html>