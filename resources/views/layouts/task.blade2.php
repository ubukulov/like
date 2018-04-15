<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <title>Likemoney.me</title>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='B-verify' content='14e5fe9055dc191ce5cb7c8dfe70ace82b9383bd' />
    <meta name="verify-admitad" content="bcfc76fe10" />

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my_styles.css') }}">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- end of /#multiple-blog-page -->
    <script type="text/javascript" src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- script for FAQ using jquery -->
    <script src="{{ asset('js/ajaxupload.js') }}"></script>

    <script src="{{ asset('js/countdown.js?1') }}" type="text/javascript"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


    <script src="{{ asset('js/jquery.maskedinput-1.3.1.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyles.css') }}">
    <script src="{{ asset('js/myscript.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body class="">
<div id="single-blog-left-sidebar" class="">
    <!-- site-navigation start -->
    <nav id="mainNavigation" class="navbar navbar-dafault main-navigation" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                    <span class="sr-only">Likemoney.me</span>
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/main_logo.png') }}" width="140" class="img-responsive center-block" alt="logo">
                    </a>
                </div>
                <!-- navbar logo -->
                <!-- navbar logo -->
            </div>
            <!-- /.navbar-header -->
            <!-- nav links -->
            <div class="collapse navbar-collapse" id="main-nav-collapse">
                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li>
                        <a href="index"><span>О НАС</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="leading_2" class="dropdown-toggle" ><span>компаниям</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="leading_1" class="dropdown-toggle"><span>Пользователям</span></a>
                    </li>
                    <li>
                    </li>
                </ul>
                <div class="loginbutton">

                    <a style="cursor: pointer;" href="account">
                        <img class="my_avatar_small" @if(!empty(Auth::user()->avatar)) src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="user-photo">
                        &nbsp;
                        {{ Auth::user()->firstname }}                                    &nbsp;
                        <font color="#619F05">0 тг.</font>
                    </a>
                    <br>


                    </button>
                </div>
                <!-- nav links -->
            </div>
        </div>    <!-- /.container -->
    </nav>
    <!-- site-navigation end -->

    <script src="{{ asset('js/upload_image_one.js') }}resources/"></script>

    <link rel="stylesheet" href="{{ asset('lib/derevo/derevo.css') }}">
    <script src="{{ asset('lib/derevo/derevo.js') }}"></script>

    <script>
        set_derevo();
        if(location.hash){
            $(function(){

                $('#vyvod_amount').focus();
            })
        }

    </script>

    <!-- header begin -->
    <header class="page-head">
        <div class="header-wrapper">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-xs-4">
                        <? if ($partner->image): ?>

                        <img class="my_avatar" src="{{ asset('uploads/partners/small/'.$partner->image) }}" width="150" height="150" alt="">

                        <? else: ?>
                        <img class="my_avatar" src="{{ asset('img/blank_avatar_220.png') }}" width="150" height="150" alt="">
                        <? endif ?>


                    </div>
                    <div class="col-md-9">
                        <font style="color:#FFF;"><h2><?= $partner->name ?></h2><font style="font-size:20px;">Статус: <b>Компания - партнер</b></font>&nbsp;<font color="#C63B3C"><i class="fa fa-question-circle"></i></font></font>
                        <br />&nbsp;
                        <div class="hidden-sm hidden-xs">
                            <div style="margin-top:80px;">
                                <ul class="nav nav-pills">
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


    <!-- Modal -->
    <div class="modal fade" id="userPaymentModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Введите сумму в тенге</h4>
                </div>

                <form method="post" action="http://likemoney.me/paybox/payment">
                    <div class="modal-body">
                        <div class="form-group">

                            <input required="" name="amount" type="text" class="form-control int" maxlength="8" placeholder="сумма">
                            <input type="hidden" name="token"  value="oMegtEWwjRQACvfyraXvR/2H">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  name="submit" class="btn-form">перейти к оплате</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- /.page-head (header end) -->

    <section class="blog-content">
        <div class="container">
            <div class="row">
                <main class="col-md-9 col-md-push-3" style="display: block;">
                    <article class="blog-item">
                        @yield('content')
                    </article>
                </main>

                <!-- begin sidebar -->
                <aside class="col-md-3 col-md-pull-9">
                    <!-- begin twitter widget -->
                    <div style="line-height:2em;">
                        <h3>Информация</h3>
                        <i class="fa fa-map-marker fa-2"></i>&nbsp;&nbsp; <?= $partner->address ?>
                        <br />

                        <? if ($partner->email): ?>
                        <i class="fa fa-envelope fa-2"></i>&nbsp;&nbsp; <?= $partner->email ?>
                        <br />
                        <? endif; ?>

                        <i class="fa fa-phone fa-2"></i>&nbsp;&nbsp; <a href="tel:<?= $partner->phone ?>"><?= $partner->phone ?></a>
                        <br />
                        <i class="fa fa-clock-o fa-2"></i>&nbsp;&nbsp; <?= $partner->hours ?>
                        <br />
                        <button type="button" class="btn-edit-user">
                            Подробнее о компании
                        </button>

                        <hr />
                        <a href="{{ asset('/files/Terms_of_use_Likemoney.me.pdf') }}" target="_blank">Пользовательское соглашение</a>
                    </div>
                </aside>
                <!-- end sidebar -->
            </div>
        </div>
    </section>

    <section class="footer-second">
        <div class="container section-wrapper">
            <!-- /.section-title -->
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="list-none">
                        <h3>О компании</h3>
                        <ul class="nav-footer">
                            <li>Что такое Likemoney.me</li>
                            <li>Новости</li>
                            <li>Акции</li>
                            <li>Вопросы и ответы</li>
                        </ul>
                    </div>
                </div>
                <!-- /.col-md-3 -->
                <div class="col-sm-3 col-xs-6">
                    <div class="list-none">
                        <h3>Компаниям</h3>
                        <ul class="nav-footer">
                            <li>Правила регистрации</li>
                            <li>Политика конфедециальности</li>
                            <li>Условия размещения</li>
                            <li>Реклама</li>
                        </ul>
                    </div>
                </div>
                <!-- /.col-md-3 -->
                <div class="col-sm-3 col-xs-6">
                    <div class="list-none">
                        <h3>Пользователям</h3>
                        <ul class="nav-footer">
                            <li>Правила регистрации</li>
                            <li>Политика конфедециальности</li>
                            <li>Личный кабинет</li>
                            <li>Помощь</li>
                        </ul>
                    </div>
                </div>
                <!-- /.col-md-3 -->
                <div class="col-sm-3 col-xs-6">
                    <div>
                        <h3>Служба поддержки</h3>
                        <h5>+7(777) 447-77-04</h5>
                        <small class="hidden-sm hidden-xs">без перерыва и выходных с 9:00 до 21:00)</small>
                        <br>info@likemoney.me
                        <br>
                        <h4>Мы в соц. сетях:</h4>
                        <i class="ion-social-facebook"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="ion-social-twitter"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="ion-social-googleplus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="ion-social-rss"></i>
                    </div>
                    <!-- /.fun-box -->
                </div>
                <!-- /.col-md-3 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- footer-navigation start -->
    <!-- footer-navigation end -->
</div>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'pcVRfboQ65';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
<script>

    $(".faq-q").click(function () {
        var container = $(this).parents(".faq-c");
        var answer = container.find(".faq-a");
        var trigger = container.find(".faq-t");

        answer.slideToggle(200);

        if (trigger.hasClass("faq-o")) {
            trigger.removeClass("faq-o");
        }
        else {
            trigger.addClass("faq-o");
        }
    });
</script>
<script>
    $(function () {
        $("#countdown-example").countdown(new Date(<?= parce_date(date('Y-m-d H:i:s', $cert->date_end), 2) ?>), 1);
    })

</script>

<script type="text/javascript" src="{{ asset('lib/reating/bootstrap-rating.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/clipboard.min.js') }}"></script>
<link href="{{ asset('lib/reating/bootstrap-rating.css') }}" rel="stylesheet" />

<script>
    $('.set_reating').rating();
</script>
<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map", {
                    center: [<?= $partner->coords; ?>],
                    zoom: 14
                }),
                // Создаем метку с помощью вспомогательного класса.
                myPlacemark1 = new ymaps.Placemark([<?= $partner->coords; ?>], {
                    // Свойства.
                    // Содержимое иконки, балуна и хинта.
                    iconContent: '',
                    balloonContent: '<?= $partner->address; ?>',
                    hintContent: '<?= $partner->name; ?>'
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
</body>
</html>