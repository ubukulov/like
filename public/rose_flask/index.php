<?php
session_start();
$url = $_SERVER["SERVER_NAME"];
$domain = explode(".",$url);
$sub_domain = $domain[0];
if($sub_domain == 'likemoney'){
    $user_phone = 77086144660;
}else{
    $user_phone = preg_replace('![^0-9]+!', '', $_SESSION['store_user_phone']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <title>Verdissimo  - долговечная роза в колбе</title>
    <!--fav-->
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="favicons/manifest.json">
    <link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#b7a385">
    <link rel="shortcut icon" href="favicons/favicon.ico">
    <meta name="msapplication-config" content="favicons/browserconfig.xml">
    <meta name="theme-color" content="#1b1519">
    <!--fav-->

    <link href="css/main.css" rel="stylesheet">
</head>

<body><section class="s-top">
    <div class="container--wide">

        <div class="top-logo">
            <img src="img/top-logo.png" alt="Verdissimo logo" width="170">
        </div>

        <nav class="top-nav">
            <a href="#s-catalog" class="scrollto">Каталог</a>
            <a href="#s-podbor" class="scrollto">Подбор</a>
            <a href="#s-info" class="scrollto">Преимущества</a>
            <a href="#s-about" class="scrollto">О бренде</a>
            <a href="#s-contacts" class="scrollto">Контакты</a>
        </nav>


        <div class="top-phone">
            <span>По вопросам оптового сотрудничества</span>
            <a href="https://api.whatsapp.com/send?phone=<?=$user_phone;?>&text=Здравствуйте!%20Я%20хотел%20бы%20заказать%20розу%20в%20колбе.%20%20Спасибо!" title="WhatsApp" target="_blank">
                <img src="img/whatsapp.png" alt=""> +<?=$user_phone;?>
            </a>
        </div>

    </div>
</section>






<section class="s-header">
    <div class="container">
        <!--	<span class="head-top">Новинка в&nbsp;мире цветочной продукции</span> -->
        <h1 class="h1">Розы в колбе</h1>
        <h1 class="h1">Оптом и в розницу</h1>
        <h1 class="h1">       от  6000 тг</h1>
        <span class="head-descr">Срок жизни 5&nbsp;лет | Опт от 5 шт | доставка по Казахстану | родом из Франции</span>
        <span class="head-descr"> </span>

        <!--	<div class="counter">
                <span class="counter__title h5">До конца акции осталось</span>
                <div class="counter__row">
                    <span class="counter__num counter__hours"></span>
                    <span class="counter__type">часов</span>
                </div>
                <div class="counter__row">
                    <span class="counter__num counter__minutes"></span>
                    <span class="counter__type">минут</span>
                </div>
                <div class="counter__row">
                    <span class="counter__num counter__seconds"></span>
                    <span class="counter__type">секунд</span>
                </div>
            </div> -->

        <!--ORDER ********* DDDDDDD  Only Email-->

        <div class="order-block">
            <p class="order-block__title h2">Акция до 8 Марта!</p>
            <form class="ajax-form vertical-form" data-modal-name="general_modal">
                <input type="text" id="name" name="name" placeholder="Введите имя*" data-label="name" data-req="true">
                <input type="tel"  id="phone" name="phone" placeholder="Введите телефон*" data-label="Phone" data-req="true">
                <input type="hidden" value="Оформление заказа (шапка сайта)" name="form_subject">
                <button type="submit" class="btn"><span>Заказать звонок</span></button>
            </form>
            <p class="order-block__privacy"> Политика конфиденциальности</p>
        </div>




        <!--ORDER ********* FULL  TELEPHONE + EMAIL->

                <div class="order-block">
                    <p class="order-block__title h2">Оптовый прайс</p>
                    <p class="order-block__descr">Оставьте заявку и скачайте оптовый прайс</p>
                    <form class="ajax-form vertical-form">
                        <input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
                        <input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
                        <input type="email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
                        <input type="hidden" value="Оформление заказа (шапка сайта)" name="form_subject">
                        <button type="submit" class="btn"><span>Условия сотрудничества</span></button>
                    </form>
                    <p class="order-block__privacy"> <a href="http://roses.vermont-design.ru/pol" target="_blank">Политика конфиденциальности</a></p>
                </div>
                **********************************-->

        <!--

            <div class="mart8" style="border-radius: 8px; border: 1px solid #ACA4A4;">
                <p class="order-block__title h3">Скидки на опт до 8 марта! </p> 	<p>	<a href="#" class="btn fancy"  data-src="#modal-openshop"><span>Условия сотрудничества</span></a></p>
            </div>
            -->


        <!--	<div class="head-triggers wp" style=" margin-top:35px">
                <div class="head-trigger">
                    <header>
                        <img src="img/trig_1.svg" alt="1">
                    </header>
                    <span>Ваша наценка от 100% </span>
                </div>
                <div class="head-trigger">
                    <header>
                        <img src="img/trig_2.svg" alt="2">
                    </header>
                    <span>Цены от производителя</span>
                </div>
                <div class="head-trigger">
                    <header>
                        <img src="img/trig_3.svg" alt="3">
                    </header>
                    <span>Сертификаты</span>
                </div>
            </div>
    -->
    </div>
</section>











<section class="s-promo wp" id="s-promo">
    <div class="container">
        <p class="h2">Роза в колбе Verdissimo это:</p>

        <div class="promo-stage">
            <img src="img/bottom.png" alt="" class="promo-stage__bottom">
            <img src="img/flower.png" alt="" class="promo-stage__flower">
            <img src="img/glass.png" alt="" class="promo-stage__glass">
        </div>

        <div class="promo promo--1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 276 312" stroke="#dbdbdb" fill="none">
                <path d="M254.42,36.5H186.5a50,50,0,0,0-96,0H21.58A21.14,21.14,0,0,1,.5,57.58V290.42A21.14,21.14,0,0,1,21.58,311.5H254.42a21.14,21.14,0,0,1,21.08-21.08V57.58A21.14,21.14,0,0,1,254.42,36.5Z"/>
            </svg>
            <header>
                <img src="img/promo_1.png" alt="1">
            </header>
            <h5 class="h5">Живут 5 лет</h5>
            <p>Мы стабилизируем цветы, чтобы они жили и&nbsp;пахли до&nbsp;5&nbsp;лет. Запах легкий и&nbsp;натуральный.</p>
        </div>

        <div class="promo promo--2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 276 312" stroke="#dbdbdb" fill="none">
                <path d="M254.42,36.5H186.5a50,50,0,0,0-96,0H21.58A21.14,21.14,0,0,1,.5,57.58V290.42A21.14,21.14,0,0,1,21.58,311.5H254.42a21.14,21.14,0,0,1,21.08-21.08V57.58A21.14,21.14,0,0,1,254.42,36.5Z"/>
            </svg>
            <header>
                <img src="img/promo_2.png" alt="1">
            </header>
            <h5 class="h5">Настоящее стекло</h5>
            <p>Колба сама по&nbsp;себе — предмет искусства. 6&nbsp;вариантов колб, сделанных на&nbsp;одном из&nbsp;старейших стеклодувных заводов Европы. </p>
        </div>

        <div class="promo promo--3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 276 312" stroke="#dbdbdb" fill="none">
                <path d="M254.42,36.5H186.5a50,50,0,0,0-96,0H21.58A21.14,21.14,0,0,1,.5,57.58V290.42A21.14,21.14,0,0,1,21.58,311.5H254.42a21.14,21.14,0,0,1,21.08-21.08V57.58A21.14,21.14,0,0,1,254.42,36.5Z"/>
            </svg>
            <header>
                <img src="img/promo_3.png" alt="1">
            </header>
            <h5 class="h5">Премиум подставка</h5>
            <p>Она сделана по&nbsp;специальной технологии из&nbsp;цельной древесины. Подставка имеет фаску для колбы и&nbsp;узорные края.</p>
        </div>

        <div class="promo promo--4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 276 312" stroke="#dbdbdb" fill="none">
                <path d="M254.42,36.5H186.5a50,50,0,0,0-96,0H21.58A21.14,21.14,0,0,1,.5,57.58V290.42A21.14,21.14,0,0,1,21.58,311.5H254.42a21.14,21.14,0,0,1,21.08-21.08V57.58A21.14,21.14,0,0,1,254.42,36.5Z"/>
            </svg>
            <header>
                <img src="img/promo_4.png" alt="1">
            </header>
            <h5 class="h5">Живая роза</h5>
            <p>Цветы Verdissimo — следующее поколение цветов. Благодаря технологии стабилизации они живые, прочные и&nbsp;не стареют.</p>
        </div>

    </div>

    <div class="promo-bg">
        <img src="img/f_1.png" alt="1" class="pbg pbg--d1">
        <img src="img/f_2.png" alt="1" class="pbg pbg--d1">
        <img src="img/f_3.png" alt="1" class="pbg pbg--d1">
        <img src="img/f_1.png" alt="1" class="pbg pbg--d1">
        <img src="img/f_2.png" alt="1" class="pbg pbg--d1">
        <img src="img/f_3.png" alt="1" class="pbg pbg--d1">
        <img src="img/m_1.png" alt="1" class="pbg pbg--d2">
        <img src="img/m_2.png" alt="1" class="pbg pbg--d2">
        <img src="img/m_3.png" alt="1" class="pbg pbg--d2">
        <img src="img/m_1.png" alt="1" class="pbg pbg--d2">
        <img src="img/m_2.png" alt="1" class="pbg pbg--d2">
        <img src="img/m_3.png" alt="1" class="pbg pbg--d2">
        <img src="img/b_1.png" alt="1" class="pbg pbg--d3">
        <img src="img/b_2.png" alt="1" class="pbg pbg--d3">
        <img src="img/b_3.png" alt="1" class="pbg pbg--d3">
        <img src="img/b_1.png" alt="1" class="pbg pbg--d3">
        <img src="img/b_2.png" alt="1" class="pbg pbg--d3">
        <img src="img/b_3.png" alt="1" class="pbg pbg--d3">
    </div>
</section>


<section class="s-colbs wp">
    <div class="container--wide">
        <p class="h2">6 размеров 22 расцветки<br> Розница</p>

        <div class="row colbs-row">
            <div class="colb" id="retail1">
                <span class="colb__num">1</span>
                <figure>
                    <img src="img/colbs/1.jpg" alt="1">
                </figure>
                <span id="colb_n1" class="colb__name">Mini</span>
                <span id="colb_d1" class="colb__descr">Высота 10&nbsp;см </span>
                <span id="colb_p1" class="colb__price">7500<span class="rub">тг</span></span>

                <a href="#" class="btn fancy"  data-src="#modal-retail1"><span>Заказать</span></a>
            </div>
            <div class="colb" id="retail2">
                <span class="colb__num">2</span>
                <figure>
                    <img src="img/colbs/2.jpg" alt="2">
                </figure>
                <span id="colb_n2" class="colb__name">Standart</span>
                <span id="colb_d2" class="colb__descr">Высота 16&nbsp;см </span>
                <span id="colb_p2" class="colb__price">11000<span class="rub">тг</span></span>

                <a href="#" class="btn fancy"  data-src="#modal-retail2"><span>Заказать</span></a>
            </div>
            <div class="colb" id="retail3">
                <span class="colb__num">3</span>
                <figure>
                    <img src="img/colbs/3.jpg" alt="3">
                </figure>
                <span id="colb_n3" class="colb__name">Premium</span>
                <span id="colb_d3" class="colb__descr">Высота 18&nbsp;см </span>
                <span id="colb_p3" class="colb__price">16500<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-retail3"><span>Заказать</span></a>
            </div>
            <div class="colb" id="retail4">
                <span class="colb__num">4</span>
                <figure>
                    <img src="img/colbs/4.jpg" alt="4">
                </figure>
                <span id="colb_n4" class="colb__name">Premium</span>
                <span id="colb_d4" class="colb__descr">Высота 22&nbsp;см </span>
                <span id="colb_p4" class="colb__price">18000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-retail4"><span>Заказать</span></a>
            </div>
            <div class="colb" id="retail5">
                <span class="colb__num">5</span>
                <figure>
                    <img src="img/colbs/5.jpg" alt="5">
                </figure>
                <span id="colb_n5" class="colb__name">Premium</span>
                <span id="colb_d5" class="colb__descr">Высота 32&nbsp;см</span>
                <span id="colb_p5" class="colb__price">23000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-retail5"><span>Заказать</span></a>
            </div>
            <div class="colb" id="retail6">
                <span class="colb__num">6</span>
                <figure>
                    <img src="img/colbs/6.jpg" alt="6">
                </figure>
                <span id="colb_n6" class="colb__name">King</span>
                <span id="colb_d6" class="colb__descr">Высота 42&nbsp;см </span>
                <span id="colb_p6" class="colb__price">26000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-retail6"><span>Заказать</span></a>
            </div>
        </div>

    </div>
</section>

<section class="s-colbs wp">
    <div class="container--wide">
        <p class="h2">6 размеров 22 расцветки <br> Оптом</p>

        <div class="row colbs-row">
            <div class="colb">
                <span class="colb__num">1</span>
                <figure>
                    <img src="img/colbs/1.jpg" alt="1">
                </figure>
                <span id="bulk_n1" class="colb__name">Mini</span>
                <span id="bulk_d1" class="colb__descr">Высота 10&nbsp;см </span>
                <span id="bulk_p1" class="colb__price">6000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk1"><span>Заказать</span></a>
            </div>
            <div class="colb">
                <span class="colb__num">2</span>
                <figure>
                    <img src="img/colbs/2.jpg" alt="2">
                </figure>
                <span id="bulk_n2" class="colb__name">Standart</span>
                <span id="bulk_d2" class="colb__descr">Высота 16&nbsp;см </span>
                <span id="bulk_p2" class="colb__price">9500<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk2"><span>Заказать</span></a>
            </div>
            <div class="colb">
                <span class="colb__num">3</span>
                <figure>
                    <img src="img/colbs/3.jpg" alt="3">
                </figure>
                <span id="bulk_n3" class="colb__name">Premium</span>
                <span id="bulk_d3" class="colb__descr">Высота 18&nbsp;см </span>
                <span id="bulk_p3" class="colb__price">13500<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk3"><span>Заказать</span></a>
            </div>
            <div class="colb">
                <span class="colb__num">4</span>
                <figure>
                    <img src="img/colbs/4.jpg" alt="4">
                </figure>
                <span id="bulk_n4" class="colb__name">Premium</span>
                <span id="bulk_d4" class="colb__descr">Высота 22&nbsp;см </span>
                <span id="bulk_p4" class="colb__price">15000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk4"><span>Заказать</span></a>
            </div>
            <div class="colb">
                <span class="colb__num">5</span>
                <figure>
                    <img src="img/colbs/5.jpg" alt="5">
                </figure>
                <span id="bulk_n5" class="colb__name">Premium</span>
                <span id="bulk_d5" class="colb__descr">Высота 32&nbsp;см</span>
                <span id="bulk_p5" class="colb__price">19000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk5"><span>Заказать</span></a>
            </div>
            <div class="colb">
                <span class="colb__num">6</span>
                <figure>
                    <img src="img/colbs/6.jpg" alt="6">
                </figure>
                <span id="bulk_n6" class="colb__name">King</span>
                <span id="bulk_d6" class="colb__descr">Высота 32&nbsp;см </span>
                <span id="bulk_p6" class="colb__price">22000<span class="rub">тг</span></span>
                <a href="#" class="btn fancy"  data-src="#modal-bulk6"><span>Заказать</span></a>
            </div>
        </div>

    </div>
</section>









<section class="s-catalog" id="s-catalog">
    <div class="container">
        <p class="h1">Бестселлеры</p>

        <div class="catalog">

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--hit">Хит</span>
                <figure>
                    <img src="img/1.jpg" alt="1">
                </figure>
                <span class="tovar__name">Premium</span>
                <span class="tovar__descr">Роза в Колбе №5</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--hit">Хит</span>
                <figure>
                    <img src="img/2.jpg" alt="2">
                </figure>
                <span class="tovar__name">Premium</span>
                <span class="tovar__descr">Роза в Колбе №5</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--hit">Хит</span>
                <figure>
                    <img src="img/3.jpg" alt="3">
                </figure>
                <span class="tovar__name">Premium</span>
                <span class="tovar__descr">Роза в Колбе №5</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--hit">Хит</span>
                <figure>
                    <img src="img/4.jpg" alt="4">
                </figure>
                <span class="tovar__name">Premium</span>
                <span class="tovar__descr">Роза в Колбе №5</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--lider">Лидер</span>
                <figure>
                    <img src="img/5.jpg" alt="5">
                </figure>
                <span class="tovar__name">King</span>
                <span class="tovar__descr">Роза в Колбе №4</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--lider">Лидер</span>
                <figure>
                    <img src="img/6.jpg" alt="1">
                </figure>
                <span class="tovar__name">King</span>
                <span class="tovar__descr">Роза в Колбе №4</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--lider">Лидер</span>
                <figure>
                    <img src="img/7.jpg" alt="7">
                </figure>
                <span class="tovar__name">King</span>
                <span class="tovar__descr">Роза в Колбе №4</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--lider">Лидер</span>
                <figure>
                    <img src="img/8.jpg" alt="8">
                </figure>
                <span class="tovar__name">King</span>
                <span class="tovar__descr">Роза в Колбе №4</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--new">New</span>
                <figure>
                    <img src="img/9.jpg" alt="9">
                </figure>
                <span class="tovar__name">King</span>
                <span class="tovar__descr">Роза в Колбе №6</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--hit">Хит</span>
                <figure>
                    <img src="img/10.jpg" alt="10">
                </figure>
                <span class="tovar__name">Mini</span>
                <span class="tovar__descr">Роза в Колбе №1</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--new">New</span>
                <figure>
                    <img src="img/11.jpg" alt="11">
                </figure>
                <span class="tovar__name">Standart</span>
                <span class="tovar__descr">Роза в Колбе №2</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

            <div class="tovar fancy" data-src="#modal-order">
                <span class="tovar__label tovar__label--new">New</span>
                <figure>
                    <img src="img/12.jpg" alt="12">
                </figure>
                <span class="tovar__name">Premium</span>
                <span class="tovar__descr">Роза в Колбе №3</span>
                <div class="tovar__price">
                </div>
                <a href="#" class="btn"><span>Заказать</span></a>
            </div>

        </div>

    </div>
</section>

<!--
<section class="s-giftcall wp">
	<div class="container">
		<p class="h2">Для подарка повод не&nbsp;нужен!</p>
		<p class="s-giftcall__text">Дарите Розы Vermont на&nbsp;праздники и&nbsp;просто так, ведь это не&nbsp;просто цветок, это изысканное дополнение интерьера.<br>Закажите 1 из 23 роз с&nbsp;помощью индивидуального подбора.</p>
		<a href="#s-podbor" class="btn scrollto"><span>Индивидуальный подбор</span></a>
	</div>
</section>
-->



<section class="s-info" id="s-info">
    <div class="container">
        <p class="h1">Долговечные цветы</p>

        <header class="info-header">
            <div class="grid-6 grid-12_s info-left">
                <p>Великолепная альтернатива искусственным и живым цветам. Это натуральные цветы и растения, их отличает прочность и долговечность за счет уникальной технологии стабилизации. Процесс стабилизации запатентован и отлажен до мелочей. Вся продукция Verdissimo делается вручную и проходит обязательную проверку на качество.</p>
                <div class="country"><span class="h5">производитель: Франция</span><img src="img/flag2.png" alt="2"></div>
            </div>
            <div class="grid-6 grid-12_s logos">
                <p class="h5">ЦВЕТЫ VERDISSIMO УКРАШАЛИ МИРОВЫЕ БРЕНДЫ</p>
                <img src="img/logos.png" alt="logos">
            </div>
        </header>


        <main class="row info-main">

            <div class="grid-6 grid-12_m">
                <div class="row">
                    <div class="grid-6 grid-12_xs">
                        <div class="inf inf--1 wp">
                            <span class="inf__title">Гарантия</span>
                            <div class="inf__content">
                                <span class="inf__val"><strong>5</strong>&nbsp;<span>лет</span></span>
                            </div>
                            <div class="inf__over">
                                <p>Гарантируем вам, что на протяжении 5 лет они сохраняют свой первозданный вид, цвет и запах.</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-6 grid-12_xs">
                        <div class="inf inf--2 wp">
                            <span class="inf__title">Технология</span>
                            <div class="inf__content">
                                Живые цветы<br>&<br>технология стабилизации
                            </div>
                            <div class="inf__over">
                                <p>Долговечные цветы Verdissimo – это великолепная альтернатива искусственным и живым цветам. Это натуральные цветы и растения.</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-12">
                        <div class="inf inf--3 wp">
                            <span class="inf__title">Ассортимент</span>
                            <div class="inf__content">
                                Уникальный подарок и&nbsp;украшение интерьера
                            </div>
                            <div class="inf__over">
                                <p>Продукция Verdissimo прекрасно подойдет в качестве роскошного и незабываемого подарка на долгую память, для оригинального и эксклюзивного украшения интерьера.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-6 grid-12_m">
                <div class="row">
                    <div class="grid-12">
                        <div class="inf inf--4 wp">
                            <span class="inf__title"></span>
                            <div class="inf__content">

                            </div>
                            <div class="inf__over">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-6 grid-12_xs">
                        <div class="inf inf--5 wp">
                            <span class="inf__title">Рейтинг</span>
                            <div class="inf__content">№1 производство <small>стабилизированных цветов в&nbsp;Казахстане и&nbsp;СНГ</small></div>
                            <div class="inf__over">
                                <p>На территории Казахстана официально стабилизацией цветов может заниматься только Verdissimo. </p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-6 grid-12_xs">
                        <div class="inf inf--6 wp">
                            <span class="inf__title">Эксклюзив</span>
                            <div class="inf__content"><small>Запатентованная технология с&nbsp;1981 года</small></div>
                            <div class="inf__over">
                                <p>Французская компания Verdissimo основана в 1981 году и является создателем запатентованной технологии стабилизации цветов и растений в мире.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
</section>


<section class="s-clients">
    <div class="container">
        <p class="h1">За 9&nbsp;лет работы в&nbsp;Казахстане и&nbsp;СНГ <small>нашими клиентами стали <span class="peoples__num" data-peoples-num="12458">0</span> человек</small></p>
        <a href="#" class="btn btn--shadow fancy" data-src="#modal-order"><span>Стать клиентом</span></a>
    </div>
</section>


<section class="s-about" id="s-about">
    <div class="container">
        <p class="h1">Бренд Verdissimo 35&nbsp;лет <small>на мировом рынке цветов</small></p>



        <div class="about-content">

            <div class="about-text">
                <p>Французская компания Verdissimo – единственная компания в мире, ежегодно выпускающая эксклюзивные коллекции неувядающих букетов и предметов интерьера из долговечных цветов на протяжении 35 лет.</p>
                <p>Пол Ламберт в 1981 году разработал уникальную технологию стабилизации растений, которая позволяет сохранять живые цветы от 3 до 10 лет в их первозданном виде, цвете и запахе. Технология стабилизации была запатентована в 1982 году, и в этот же год основана франко-бельгийская компания Verdissimo.</p>

            </div>

            <div class="about-prizes">
                <div class="about-prize">
                    <img src="img/prize_1.svg" alt="prize">
                    <span class="h5">Официально для королевских дворов</span>
                    <p>Букеты и композиции для декора Verdissimo были неоднократно представлены лично владельцами компании Полом Ламбертом и Жанет Уильямс на королевских приемах в Европе.</p>
                </div>
                <div class="about-prize">
                    <img src="img/prize_2.svg" alt="prize">
                    <span class="h5">1 место в мире >75 международных наград</span>
                    <p>В партнерстве с дизайнером Marcel Wolterinck компани Verdissimo заняла первое место в 1997 году на самой престижной в Мире дизайнерской выставке Maison & Objet в Париже.</p>
                </div>
            </div>

            <div class="serts">
                <h5 class="h5">Сертификаты</h5>
                <div class="sert-slider">
                    <a href="img/serts/1.jpg" class="sert-slide fancy" data-fancybox="serts"><img src="img/serts/1_s.jpg" alt="1"></a>
                    <a href="img/serts/2.jpg" class="sert-slide fancy" data-fancybox="serts"><img src="img/serts/2_s.jpg" alt="2"></a>
                    <a href="img/serts/3.jpg" class="sert-slide fancy" data-fancybox="serts"><img src="img/serts/3_s.jpg" alt="3"></a>
                </div>
            </div>

        </div>

    </div>
</section>


<!--  <section class="s-store">
      <div class="container">

          <div class="store">
              <span class="store__title h2">Откройте свой магазин стабилизированных цветов</span>
              <p>Компания Verdissimo работает по франчайзинговой модели. За последние 3 месяца мы открыли 15 точек продаж: шоу-рум, магазины в Торговых Центрах, островки стабилизированных цветов в разных городах России и СНГ.</p>
              <p class="store__big">Вы можете стать успешным предпринимателем вместе с&nbsp;нами.
                  Узнайте больше — просто оставьте заявку.</p>
              <a href="#" class="btn fancy" data-src="#modal-openshop"><span>Открыть свой магазин</span></a>
              <div class="store__order">
                  <a href="#" class="fancy h5" data-src="#modal-opt">Заказать розу в колбе оптом</a>
              </div>
          </div>

      </div>
  </section> -->



<section class="s-designers">
    <div class="container">
        <p class="h1">Коллекции Verdissimo <small>создаются дизайнерами с&nbsp;мировыми именами</small></p>

        <div class="row designers-row">
            <div class="designer">
                <figure><img src="img/designers/1.jpg" alt="Jos Van Dyck"></figure>
                <span class="h5">Jos Van Dyck</span>
            </div>
            <div class="designer">
                <figure><img src="img/designers/2.jpg" alt="Annette Stampek"></figure>
                <span class="h5">Annette Stampe</span>
            </div>
            <div class="designer">
                <figure><img src="img/designers/3.jpg" alt="Christian Tortu"></figure>
                <span class="h5">Christian Tortu</span>
            </div>
            <div class="designer">
                <figure><img src="img/designers/4.jpg" alt="Daniel Ost"></figure>
                <span class="h5">Daniel Ost</span>
            </div>
            <div class="designer">
                <figure><img src="img/designers/5.jpg" alt="Paul Morris"></figure>
                <span class="h5">Paul Morris</span>
            </div>
        </div>
    </div>
</section>


<section class="s-collections">
    <div class="container">

        <div class="collect">
            <p class="collect__title h2">Роза Verdissimo</p>
            <p class="collect__descr">Изысканное украшение вашего интерьера</p>
            <a href="#" class="btn btn--shadow fancy" data-src="#modal-order"><span>Выбрать розу в колбе</span></a>
        </div>

    </div>
</section>


<section class="s-sale">
    <div class="container">
        <p class="h1">Закажите розу в колбе Verdissimo</p>

        <!--ORDER ********* DDDDDDD  Only Email-->

        <div class="order-block">
            <p class="order-block__title h2">Закажите розу в колбу</p>
            <form class="ajax-form vertical-form" data-modal-name="vr_rose">
                <input type="text" id="vr_name" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
                <input type="tel" id="vr_phone" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
                <input type="hidden" value="Оформление заказа (внизу сайта)" name="form_subject">
                <button type="submit" class="btn"><span>Заказать</span></button>
            </form>
            <p class="order-block__privacy">Ваши данные не будут переданы третьим лицам</p>
        </div>
        <!-- ORDER FULL DDDDDDDDDD TEL + EMAIL
        <div class="order-block">
            <p class="order-block__title h2">Оптовый прайс</p>
            <p class="order-block__descr">Оставьте заявку и скачайте оптовый прайс</p>
            <form class="ajax-form vertical-form">
                <input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
                <input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
                <input type="email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
                <input type="hidden" value="Оформление заказа (внизу сайта)" name="form_subject">
                <button type="submit" class="btn"><span>Заказать</span></button>
            </form>
            <p class="order-block__privacy">Ваши данные не будут переданы третьим лицам</p>
        </div>

        -->

    </div>
</section>
<section class="s-faq">
    <div class="container">

        <div class="row">

            <div class="grid-6 grid-12_m faq">
                <p class="h2">Частые вопросы</p>

                <div class="faq-item">
                    <div class="faq-item__q h5">1. Правда ли&nbsp;роза в&nbsp;колбе живет 5&nbsp;лет?</div>
                    <div class="faq-item__a">
                        <p>Мы единственные представители компании Verdissimo  в Казахстане и на территории СНГ, и у нас есть гарантия на срок состояния цветов.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-item__q h5">2. Как нужно ухаживать за розой в колбе?</div>
                    <div class="faq-item__a">
                        <p>Уход самый простой. Если запылятся - продуйте феном на слабой скорости прохладным воздухом. Ставить в воду не нужно, от солнца держать подальше. Тестирования показывают, что при таком уходе подарок выдерживает максимальный срок.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-item__q h5">3. В чем состоит фирменная технология?</div>
                    <div class="faq-item__a">
                        <p>В живую розу взамен естественного сока вводится бальзамированный сок, по экологичной формуле: растение безопасно даже если его употребить в пищу.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-item__q h5">4. Можно ли достать цветок из колбы и благоприятно ли это?</div>
                    <div class="faq-item__a">
                        <p>Колба открывается, и цветок извлекается легко. Однако, весь смысл подарка в том, что стекло защищает цветок от пыли и другого внешнего воздействия.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-item__q h5">5. Где можно ознакомиться с сертификатами качества вашей продукции?</div>
                    <div class="faq-item__a">
                        <p>На данном сайте или на официальном сайте производителя Verdissimo.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-item__q h5">6. Что еще нужно знать о розах в колбе?</div>
                    <div class="faq-item__a">
                        <p>Подпишитесь на нас в соц сетях, чтобы вместе с другими клиентами делиться опытом и впечатлениями!</p>
                    </div>
                </div>
            </div>

            <div class="grid-6 grid-12_m faq-form">
                <p class="h3">Задайте свой вопрос</p>
                <div class="faq-form__block">
                    <form class="ajax-form vertical-form" data-modal-name="fq">
                        <input type="text" id="fq_name" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
                        <input type="tel" id="fq_phone" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
                        <input type="email" id="fq_email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
                        <textarea id="fq_txt" name="user_question" rows="4" data-req="true" data-label="Вопрос" placeholder="Ваш вопрос*"></textarea>
                        <input type="hidden" value="Задали вопрос" name="form_subject">
                        <button type="submit" class="btn"><span>Отправить вопрос</span></button>
                    </form>
                    <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
                </div>
            </div>

        </div>

    </div>
</section>





<section class="s-footer">
    <div class="container">
        <div class="row">
            <div class="grid-6 grid-4_l grid-6_m grid-12_xs foot-col">
                <p>© 2018 Все права защищены. При любом копировании материалов ссылка на сайт-источник обязательна.</p>

                <p>Политика конфиденциальности</p><br>
                <p> <br>
            </div>
            <div class="grid-3 grid-4_l grid-6_m grid-12_xs foot-col">
                <p>Адрес: Каирбекова 16, ниже Гоголя, подъезд 3, цокольный этаж</p>
            </div>
            <div class="grid-3 grid-3_l grid-12_m foot-col foot-col__last">
                <div class="socials">
                    <a href="https://api.whatsapp.com/send?phone=<?=$user_phone;?>&text=Здравствуйте!%20Я%20хотел%20бы%20заказать%20розу%20в%20колбе.%20%20Спасибо!" title="WhatsApp" target="_blank">
                        <img src="img/whatsapp.png" alt=""> +<?=$user_phone;?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--
<div class="modal modal-sale" id="modal-sale">
	<div class="m-sale">
		<div class="m-sale__left"></div>
		<div class="m-sale__content">
			<p class="m-sale__title">Акция</p>
			<p class="m-sale__descr">powerbank бесплатно</p>
			<p class="m-sale__actions">Введите телефон в поле ниже и&nbsp;нажмите на кнопку “Участвую!”</p>
			<form class="ajax-form vertical-form">
				<input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
				<input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
				<input type="hidden" value="Участие в акции" name="form_subject">
				<button type="submit" class="btn"><span>Участвую!</span></button>
			</form>
			<p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
		</div>
	</div>
</div>

-->






<!-- Модальные окна -->
<div class="modals-sec">


    <!--DDDDD ORDER Only Email******************* -->

    <!-- <div id="modal-call" class="modal">

        <p class="modal__descr">Оптовый прайс и условия</p>
        <form class="ajax-form vertical-form">
            <input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Заказ обратного звонка" name="form_subject">
            <button type="submit" class="btn"><span>Скачать  прайс</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-order" class="modal">
        <p class="modal__title">Оптовый прайс и условия</p>
        <p class="modal__descr">Скачать оптовый прайс</p>
        <form class="ajax-form vertical-form">

            <input type="email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
            <input type="hidden" value="Оформление заказа (модальное окно)" name="form_subject">
            <button type="submit" class="btn"><span>Скачать прайс</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-opt" class="modal">
        <p class="modal__title">Оптовый прайс и условия</p>
        <p class="modal__descr">Скачать оптовый прайс</p>
        <form class="ajax-form vertical-form">

            <input type="email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
            <input type="hidden" value="Оптовый заказ" name="form_subject">
            <button type="submit" class="btn"><span>скачать прайс</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-openshop" class="modal">
        <p class="modal__title">Оптовый прайс и условия</p>
        <p class="modal__descr">Скачать оптовый прайс</p>
        <form class="ajax-form vertical-form">

            <input type="email" name="user_email" placeholder="Введите e-mail*" data-label="Email" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Скачать прайс</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div> -->




    <!--********FULL ORDER EMAIL + TELEPHONE-->
    <input type="hidden" id="user_phone" value="<?=$user_phone;?>">
    <div id="modal-order" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal_stat">
            <input type="text" id="st_name" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel" id="st_phone" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Оформление заказа (модальное окно)" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-opt" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form">
            <input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Оптовый заказ" name="form_subject">
            <button type="submit" class="btn"><span>Заазать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-openshop" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form">
            <input type="text" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <!-- розы в розницу -->
    <div id="modal-retail1" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="1">
            <input type="text" id="retail_name1" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone1" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-retail2" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="2">
            <input type="text" id="retail_name2" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone2" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-retail3" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="3">
            <input type="text" id="retail_name3" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone3" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-retail4" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="4">
            <input type="text" id="retail_name4" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone4" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-retail5" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="5">
            <input type="text" id="retail_name5" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone5" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-retail6" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-retail" data-value="6">
            <input type="text" id="retail_name6" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="retail_phone6" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>
    <!-- розы в розницу -->

    <!-- розы в оптом -->
    <div id="modal-bulk1" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="1">
            <input type="text" id="bulk_name1" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone1" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-bulk2" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="2">
            <input type="text" id="bulk_name2" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone2" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-bulk3" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="3">
            <input type="text" id="bulk_name3" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone3" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-bulk4" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="4">
            <input type="text" id="bulk_name4" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone4" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-bulk5" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="5">
            <input type="text" id="bulk_name5" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone5" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>

    <div id="modal-bulk6" class="modal">
        <p class="modal__title">Заказать</p>
        <form class="ajax-form vertical-form" data-modal-name="modal-bulk" data-value="6">
            <input type="text" id="bulk_name6" name="user_name" placeholder="Введите имя" data-label="Имя пользователя">
            <input type="tel"  id="bulk_phone6" name="user_tel" data-label="Телефон" placeholder="Введите телефон*" data-req="true">
            <input type="hidden" value="Открытие магазина" name="form_subject">
            <button type="submit" class="btn"><span>Заказать</span></button>
        </form>
        <p class="modal__privacy">Ваши данные не будут переданы третьим лицам</p>
    </div>
    <!-- розы в оптом -->

    ******




    <div id="modal-thanks" class="modal">
        <p class="modal__title modal__title--thanks">На Ваш Email отправлен прайc  <br></p>
        <h4>через 5 сек. откроется страница условий</h4>
    </div>

    <div id="modal-was-order" class="modal">
        <p class="modal__title modal__title--thanks">  <a href="http://roses.vermont-design.ru/Price_Vermont.xlsx" class="btn"><span>скачать оптовый прайс</span></a>    </p>
    </div>

</div>
<!-- Модальные окна -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/assets.js" type="text/javascript" ></script>
<script src="js/main.js" type="text/javascript" ></script>




<script type="text/javascript" src="//track.adspire.io/code/rosersvermont/"></script>





<style type="text/css">
    .to_qwest{
        display: block;
        width: 200px;
        height: 38px;
        position: fixed;
        right: 388px;
        bottom: 0px;
        background: #4caf50;
        color: #ffffff;
        text-align: center;
        line-height: 38px;
        text-align: center;
        z-index: 99999;
        cursor: pointer;
        border-radius: 8px 8px 8px 8px ;
        -moz-border-radius: 8px 8px 8px 8px;
        -khtml-border-radius: 8px 8px 8px 8px;
    }
</style>


<!--Кнопка ответов на вопросы-->

<div class="to_qwest" target="_blank" onclick="window.location='http://www.vermont-design.ru/otvet.html'">
    Ответы на вопросы.
</div>







</body>
</html>
