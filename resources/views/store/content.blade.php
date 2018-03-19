@extends('layouts.item')
@section('content')
    <div class="row_tsk">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-heading">
                    <h3><?= $cert->title; ?></h3>
                </div>
            </div>

            <div class="col-md-3">
                <span style="color: forestgreen; font-weight: 600;">Код товара: @if(!empty($cert->article_code)) {{ $cert->article_code }} @else {{ $cert->id }} @endif</span>
            </div>
        </div>

        <hr />
        <div class="row">
            <div class="col-md-5">
                <div style="width: 350px" id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @if(!empty($cert->image) AND $cert->image != '' AND file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$cert->image))
                            <div class="item active">
                                <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image) }}" alt="foto">
                            </div>
                        @endif
                        @if(!empty($cert->image2) AND $cert->image2 != '' AND file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$cert->image2))
                            <div class="item">
                                <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image2) }}" alt="foto">
                            </div>
                        @endif
                        @if(!empty($cert->image3) AND $cert->image3 != '' AND file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$cert->image3))
                            <div class="item">
                                <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image3) }}" alt="foto">
                            </div>
                        @endif
                    </div>
                    @if(!empty($cert->image2) AND $cert->image2 != '' AND file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$cert->image2))
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-md-7" style="padding-left: 30px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="price">
                            @if($sub_domain != 'optprice.')
                                <font style="color:#619F05"><i class="fa fa-credit-card fa-2"></i></font>&nbsp;&nbsp;Цена:<br /><font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($cert->special2,0,' ',' ') ?> тг.</font>
                            @else
                                <font style="color:#619F05"><i class="fa fa-credit-card fa-2"></i></font>&nbsp;&nbsp;Оптовая цена:<br />
                                @if(!empty($cert->opt_price1))
                                    <font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">от <strong><?= (int) $cert->opt_count1 ?></strong> шт. {{ number_format($cert->opt_price1,0,' ',' ') }} тг.</font><br />
                                @endif

                                @if(!empty($cert->opt_price2))
                                    <font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">от <strong><?= (int) $cert->opt_count2 ?></strong> шт. {{ number_format($cert->opt_price2,0,' ',' ') }} тг.</font><br />
                                @endif

                                @if(!empty($cert->opt_price3))
                                    <font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">от <strong><?= (int) $cert->opt_count3 ?></strong> шт. {{ number_format($cert->opt_price3,0,' ',' ') }} тг.</font><br />
                                @endif
                            @endif
                        </div>
                        <div style="margin-top: 15px;">
                            <span style="color: green; margin-left: 30px;">Есть в наличии</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cert_button" style="padding-bottom: 10px;">
                            <a style="width: 100px; font-size: 14px;" @if(Auth::check()) href="{{ url('/store/item/'.$cert->id) }}" @else href="{{ url('/user/login') }}" @endif class="btn btn-danger">Купить</a>
                            <button style="font-size: 14px; width: 100px;" type="button" onclick="addToCartItem({{ $cert->id }});" class="btn btn-danger">В корзину</button>
							<br />
							<a href="https://api.whatsapp.com/send?phone=77758153538&text=Здравствуйте!%20Я%20хотел%20бы%20узнать%20цену%20по%20товару%20'<?php echo $cert->title; ?>%20(<?php echo $cert->special2; ?>%20тг.)'!.%20%20Спасибо!%20Код товара:%20<?php echo $cert->article_code; ?>%20Товар%20по%20этому%20адресу:%20http://<?php echo $sub_domain; ?>likemoney.me/item/<?php echo $cert->id ?>" target="_blank"><img src="/img/whatsapp_button1.png" /></a>
                        </div>
                        <div id="msg" class="hidden"></div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-sm-5">
                                <input type="hidden" name="_token" id="buy_token" value="{{ csrf_token() }}">
                                <input style="width: 105px;" type="text" class="phone3" id="buy_one" placeholder="Ваш телефон">
                            </div>
                            <div class="col-sm-7">
                                <button type="button" onclick="buy_1_click({{ $cert->id }});" disabled="disabled" id="btn_buy_one" class="" style="font-size: 11px; border: none; border-radius: 0; padding: 6px; width: 95px;">В 1 клик</button>
                            </div>
                            <style>
                                .phone3:hover{
                                    border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; border-left: 1px solid #ccc;
                                }
                                .phone3{
                                    width: 141px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; font-size: 11px; padding: 5px;
                                }
                            </style>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="last_time" style="padding: 10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Хочешь получить скидку? <br> от 500 до 2000тг</label>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('/task') }}" class="playbutton">
                                <i class="fa fa-play fa-2"></i>&nbsp;&nbsp;&nbsp;Посмотреть задания
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="cert_statistics" style="padding-bottom: 10px;">
                    <font style="color:#d7d7d7"> <i class="fa fa-thumbs-up fa-2"></i></font>&nbsp;&nbsp;Уже купили: <?=$count_sell_certs;?> чел.<br /><font style="color:#d7d7d7"><i class="fa fa-eye fa-2"></i></font>&nbsp;&nbsp;Заинтересовались: <?= $cert->views ?> чел.
                </div>
                <hr>
                <div class="cert_social">
                    <script type="text/javascript">
                        (function () {
                            if (window.pluso)
                                if (typeof window.pluso.start == "function")
                                    return;
                            if (window.ifpluso == undefined) {
                                window.ifpluso = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript';
                                s.charset = 'UTF-8';
                                s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
                                var h = d[g]('body')[0];
                                h.appendChild(s);
                            }
                        })();
                    </script>
                    <div class="pluso" data-background="#ebebeb" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir"></div>
                </div>
            </div>
        </div>
        <br><br>
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Описание</a></li>
                <li><a href="#tabs-2">Характеристики</a></li>
                <li><a href="#tabs-3">Отзывы ()</a></li>
            </ul>
            <div id="tabs-1">
                <p>{!! htmlspecialchars_decode($cert->conditions) !!}</p>
            </div>
            <div id="tabs-2">
                <p>{!! htmlspecialchars_decode($cert->features) !!}</p>
            </div>
            <div id="tabs-3">

            </div>
        </div>
    </div>
    <br><br>

    {{--<div class="row_tsk">--}}

        {{--<div  class="task_map">--}}
            {{--<div id="map" style="height: 300px" class="blog-heading">--}}
                {{--<h3>Задание на карте</h3>--}}

            {{--</div>--}}

        {{--</div>--}}

    {{--</div>--}}
@stop