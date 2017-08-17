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
                            <img width="400" src="{{ asset('uploads/certs/'.$cert->image) }}" alt="foto">
                        </div>
                        @endif
                        @if(!empty($cert->image2))
                        <div class="item">
                            <img width="400" src="{{ asset('uploads/certs/'.$cert->image2) }}" alt="foto">
                        </div>
                        @endif
                        @if(!empty($cert->image3))
                        <div class="item">
                            <img width="400" src="{{ asset('uploads/certs/'.$cert->image3) }}" alt="foto">
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
                <div class="price">
                    <font style="color:#619F05"><i class="fa fa-credit-card fa-2"></i></font>&nbsp;&nbsp;Вознаграждение:<br /><font style="font-family: ubuntu; font-size: 20px; font-weight: 600; color:#619F05">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $cert->special1 ?></font>
                </div>

                <div class="last_time">
                    <font style="color:#d7d7d7"> <i class="fa fa-clock-o fa-2"></i></font>
                    &nbsp;&nbsp;До окончания осталось:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font style="font-weight: 600; text-decoration: underline" id="getting-started"></font>
                    <div class="clock"></div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            var clock = $('.clock').FlipClock({{ $cert->date_end - time() }}, {
                                clockFace: 'DailyCounter',
                                countdown: true
                            });
                            clock.setCountdown(true);
                            clock.start();

                        });
                    </script>
                </div>
                <br>
                <div class="cert_button" style="border-bottom:1px solid #d7d7d7; padding-bottom: 10px;">
                    <button type="button" class="playbutton" data-toggle="modal" data-target="#taskSubs">
                        <i class="fa fa-play fa-2"></i>&nbsp;&nbsp;&nbsp;Посмотреть задания
                    </button>
                </div>
                <br>
                <div class="cert_statistics" style="border-bottom:1px solid #d7d7d7; padding-bottom: 10px;">
                    <font style="color:#d7d7d7"> <i class="fa fa-thumbs-up fa-2"></i></font>&nbsp;&nbsp;Уже купили:  чел.<br /><font style="color:#d7d7d7"><i class="fa fa-eye fa-2"></i></font>&nbsp;&nbsp;Посмотрели задание: <?= $cert->views ?> чел.
                </div>
                <br>
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
                <li><a href="#tabs-1">Задание</a></li>
                <li><a href="#tabs-2">Описание</a></li>
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
@stop