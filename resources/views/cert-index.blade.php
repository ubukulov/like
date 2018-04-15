@extends('layouts.cert')
@section('content')
    <div class="row_tsk">
        <div class="blog-heading">
            <h3><?= $cert->title; ?></h3>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-5">
                <div style="width: 400px" id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @if(!empty($cert->image))
                        <div class="item active">
                            <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image) }}" alt="foto">
                        </div>
                        @endif
                        @if(!empty($cert->image2))
                        <div class="item">
                            <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image2) }}" alt="foto">
                        </div>
                        @endif
                        @if(!empty($cert->image3))
                        <div class="item">
                            <img style="width: 400px;" src="{{ asset('uploads/certs/'.$cert->image3) }}" alt="foto">
                        </div>
                        @endif
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7" style="padding-left: 30px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="price">
                            <font style="color:#619F05"><i class="fa fa-credit-card fa-2"></i></font>&nbsp;&nbsp;Цена:<br /><font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $cert->special1 ?></font>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cert_button" style="padding-bottom: 10px;">
                            <button style="width: 220px;" type="button" class="playbutton" onclick="certDetails();">
                                <i class="fa fa-play fa-2"></i>&nbsp;&nbsp;&nbsp;Купить
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="last_time" style="padding: 10px;">
                    {{--<font style="color:#d7d7d7"> <i class="fa fa-clock-o fa-2"></i></font>--}}
                    {{--&nbsp;&nbsp;До окончания осталось:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                    {{--<font style="font-weight: 600; text-decoration: underline" id="getting-started"></font>--}}
                    {{--<div class="clock"></div>--}}

                    {{--<script type="text/javascript">--}}
                        {{--$(document).ready(function() {--}}
                            {{--var clock = $('.clock').FlipClock({{ $cert->date_end - time() }}, {--}}
                                {{--clockFace: 'DailyCounter',--}}
                                {{--countdown: true--}}
                            {{--});--}}
                            {{--clock.setCountdown(true);--}}
                            {{--clock.start();--}}

                        {{--});--}}
                    {{--</script>--}}
                    <div class="row">
                        <div class="col-md-6">
                            <label>Хочешь получить скидку? <br> 10%</label>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="playbutton">
                                <i class="fa fa-play fa-2"></i>&nbsp;&nbsp;&nbsp;Посмотреть задания
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="cert_statistics" style="padding-bottom: 10px;">
                    <font style="color:#d7d7d7"> <i class="fa fa-thumbs-up fa-2"></i></font>&nbsp;&nbsp;Уже купили:  чел.<br /><font style="color:#d7d7d7"><i class="fa fa-eye fa-2"></i></font>&nbsp;&nbsp;Заинтересовались: <?= $cert->views ?> чел.
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
    <div class="row_tsk">

        <div  class="task_map">
            <div id="map" style="height: 300px" class="blog-heading">
                <h3>Задание на карте</h3>

            </div>

        </div>

    </div>
    <br><br>
    <div class="row_tsk">
        <div class="blog-heading">
            <h3>Особенности</h3>
        </div>
        <img src="{{ asset('img/attention.png') }}" alt="attention" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
        <font color="#cc0033"><em>Для получения вознаграждения предъявите карту Likemoney.me <font color="#d7d7d7"><i class="fa fa-question-circle fa-2"></i></font><br />
                &nbsp;&nbsp;&nbsp;&nbsp;К Вам на телефон придет уведомление о начислении вознаграждения</em></font>
    </div>
    <div class="ui modal large" style="top:0px; height: 550px; width: 1000px; padding: 20px;">
        <div class="content" style="padding: 10px;">
            <div class="row">
                <h2 class="green">Виды предложений</h2>
                <hr>
                <table class="table" style="font-size: 14px;">
                    <thead>
                        <th>Описание</th>
                        @if($cert->cert_type == 3)
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <td></td>
                        @else
                        <th>Цена</th>
                        <th>Купили</th>
                        <th>Осталось</th>
                        <th>Доход</th>
                        <th>Действие</th>
                        @endif
                    </thead>
                    <tbody>
                    @foreach($certs_sub as $sub)
                        <tr>
                            <td>{{ $sub->title }}</td>
                            @if($cert->cert_type == 3)
                            <td><?= $sub->limit ?></td>
                            <td><?= $sub->price ?></td>
                            <td>
                                <a style="width: 200px; padding: 4px;" class="btn btn-lg btn-block btn-confirm actbutton" href="/add_to_cart.php?offer=<?=$sub->id;?>&type=buy&coupon=1">Купить сейчас</a>
                            </td>
                            @else
                            <td width="130">
                                <span style="text-decoration: line-through; font-size: 12px;color:#000000;"><?=$sub->price_minus?> тг</span><br>
                                <span style="color: green; font-weight: bold;color:#619F05"><?=$sub->price?> тг</span>
                            </td>
                            @endif
                            <td style="text-align: center;"><?= $sub->purchased ?></td>
                            <td style="text-align: center;"><?= $sub->limit ?></td>
                            <td width="130" style="text-align: center;">
                                <font style="font-family: ubuntu; font-size: 15px; font-weight: 600; color:#619F05"><i class="fa fa-credit-card fa-2"></i>&nbsp;&nbsp;<?= $sub->com_agent ?> <?
                                    if ($sub->type == 1) {
                                        echo 'тг.';
                                    } elseif ($sub->type == 2) {
                                        echo '%';
                                    }
                                    ?></font>
                            </td>
                            <td>
                                <a style="margin-bottom: 10px;" class="btn btn-danger" @if(Auth::check()) href="{{ url('/cart/offer/'.$sub->id) }}" @else href="{{ url('/user/login') }}" @endif>Купить сейчас</a><br>
                                <button type="button" onclick="addToCart({{ $sub->id }});" class="btn btn-danger">Добавить в корзину</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <br>
        <hr>
        <button id="closeCertDetails" type="button" class="btn btn-danger right"><i class="remove small circle icon"></i>&nbsp;&nbsp;Закрыть окно</button>
        <br><br>
        <div id="positive" class="hidden">

        </div>
        </div>
    </div>
@stop