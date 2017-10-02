@extends('layouts.app')
@section('content')
    <div class="row_tsk">
        <div id="mainmenu">
            <ul>
                {!! $cat_menu !!}
            </ul>
        </div>
        <hr>
        <div class="row">
            @foreach($certs as $key=>$cert)
                <div class="col-md-3">
                    <div class="brd">
                        <div class="portfolio-item">
                            <!-- /.portfolio-img -->
                            <a href="{{ url('/cert/'.$cert->id) }}">

                                <div class="portfolio-img" style="height: 160px; cursor: pointer;">
                                    <img @if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/certs/small/'.$cert->image) && !empty($cert->image)) src="{{ asset('uploads/certs/small/'.$cert->image) }}" @else src="{{ asset('img/no_photo227x140.png') }}" @endif alt="port-1" class="port-item">
                                    <div class="portfolio-img-hover">

                                    </div>
                                    <!-- /.portfolio-img-hover -->
                                </div>
                            </a>
                            <div class="portfolio-item-details">
                                <div class="portfolio-item-name">{{ $cert->title }}</div>
                                <!-- /.portfolio-item-name -->
                                <div style="float: left;">
                                    <table>
                                        <tbody>
                                        <tr>
                                            @if($cert->cert_type == 2)
                                                <!-- Бизнес -->
                                                @if(empty($cert->special3) AND $cert->special3 == 0)
                                                    <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                                    <td style="width: 130px;padding-left:7px; line-height: 15px;"><small>Цена:<br><font color="#62A005"><b>{{ $cert->special2 }}</b></font></small></td>
                                                @else
                                                <td width="130">
                                                    <span style="text-decoration: line-through; font-size: 12px;">{{ $cert->special2 }} тг</span><br>
                                                    <span style="color: green; font-weight: bold;">{{ $cert->special3 }} тг</span>
                                                </td>
                                                @endif
                                                @if(is_tariff(Auth::id()))
                                                    <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                                    <td style="padding-left:7px; line-height: 15px;"><small>cashback:<br><font color="#62A005"><b>{{ $cert->special1 }}</b></font></small></td>
                                                @else
                                                <td align="right">
                                                    <a href="{{ url('/cert/'.$cert->id) }}" class="hidden-xs taskbutton">Подробнее</a>
                                                </td>
                                                @endif
                                            @endif

                                            <?php if($cert->cert_type == 3) :?>
                                            <!-- Купон -->
                                            <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                            <td style="padding-left:7px; line-height: 15px; width: 130px;"><small>скидка:<br><font color="#62A005"><b><?= $cert->special1 ?></b></font></small></td>
                                            <td align="right">
                                                <a href="{{ url('/cert/'.$cert->id) }}" class="hidden-xs taskbutton">Подробнее</a>
                                            </td>
                                            <?php endif; ?>

                                            <?php if($cert->cert_type == 1) :?>
                                            <!-- Задания -->
                                            <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                            <td style="padding-left:7px; line-height: 15px; width: 130px;">
                                                <small>@if($key == 0)Франшиза:@else cashback: @endif<br><font color="#62A005"><b><?= $cert->special1 ?></b></font></small>
                                            </td>
                                            <td align="right">
                                                <a href="{{ url('/cert/'.$cert->id) }}" class="hidden-xs taskbutton">Подробнее</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.portfolio-item-details -->
                        </div>
                    </div>
                    <!-- /.portfolio-item -->
                </div>
            @endforeach
        </div>
    </div>
    <style>
        #mainmenu {
            position: relative;
            border: 1px solid #222;
            background-color: #111;
            background-image: -moz-linear-gradient(#444, #111);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
            background-image: -webkit-linear-gradient(#444, #111);
            background-image: -o-linear-gradient(#444, #111);
            background-image: linear-gradient(#444, #111);
            border-radius: 6px;
            -moz-border-radius: 6px;
            -o-border-radius: 6px;
            -webkit-border-radius: 6px;
            -ms-border-radius: 6px;
            box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            -moz-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            -o-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            -ms-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            -webkit-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
            height: 40px;
            /*margin: 50px auto;*/
            /*padding: 0;*/
            /*width: 960px;*/
            z-index: 10/* для отображения подпунктов поверх остальных блоков */
        }

        #mainmenu ul, /* сбрасываем поля и отступы у списков */
        #mainmenu ul ul,
        #mainmenu ul ul li {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #mainmenu ul {
            clear: left;
            position: relative;
            right: 50%;
            height: 40px;
            /*float: right;*/
            text-align: left;
            font: 12px Arial, Helvetica, sans-serif;
            text-transform: uppercase;
        }
        #mainmenu ul li {
            border-right: 1px solid #222;
            box-shadow: 1px 0 0 #444;
            -moz-box-shadow: 1px 0 0 #444;
            -o-box-shadow: 1px 0 0 #444;
            -ms-box-shadow: 1px 0 0 #444;
            -webkit-box-shadow: 1px 0 0 #444;
            position: relative;
            left: 50%;
            float: left;
            height: 39px;
        }
        #mainmenu ul li:last-child {
            border: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none
        }
        #mainmenu ul li a {
            display: block;
            color: #ccc;
            text-decoration: none;
            padding: 13px 25px
        }
        #mainmenu ul > li:hover > a {
            background-color: #0186BA;
            background-image: -moz-linear-gradient(#04acec, #0186ba);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba));
            background-image: -webkit-linear-gradient(#04acec, #0186ba);
            background-image: -o-linear-gradient(#04acec, #0186ba);
            background-image: linear-gradient(#04acec, #0186ba);
            color: #fafafa
        }

        /** Индикатор наличия подкатегорий верхнего уровня **/

        #mainmenu > ul > li.parent > a::after {
            border-left: 1px solid #CCC;
            border-top: 1px solid #CCC;
            content: "";
            display: inline-block;
            vertical-align: top;
            margin: 4px 0 0 8px;
            -webkit-transform: rotate(-135deg);
            -moz-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            -o-transform: rotate(-135deg);
            transform: rotate(-135deg);
            height: 5px;
            width: 5px;
        }

        /*************************** Выпадающие подпункты **/

        #mainmenu ul li ul {
            background: #444;
            background: -moz-linear-gradient(#444, #111);
            background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
            background: -webkit-linear-gradient(#444, #111);
            background: -o-linear-gradient(#444, #111);
            background: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
            background: linear-gradient(#444, #111);
            border-radius: 3px;
            -moz-border-radius: 3px;
            -o-border-radius: 3px;
            -ms-border-radius: 3px;
            -webkit-border-radius: 3px;
            transition: all .2s ease-in-out;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            text-transform: none;
            opacity: 0;
            visibility: hidden;
            position: absolute;
            left: 0;
            line-height: 18px;
            top: 39px;
            font-size: 12px;
            margin-top: 20px;
            height: auto;
            min-width: 150px;
            width: 100%
        }
        #mainmenu ul li:hover > ul {
            opacity: 1;
            visibility: visible;
            -webkit-transition: margin 0.3s ease 0s;
            -moz-transition: margin 0.3s ease 0s;
            -o-transition: margin 0.3s ease 0s;
            transition: margin 0.3s ease 0s;
            margin: 0;
            z-index: 11;
        }
        #mainmenu ul li ul li {
            border: none;
            box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            -moz-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            -o-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            -webkit-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            -ms-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
            position: relative;
            left: 0;
            float: none;
            height: auto;
            text-align: left !important;
        }
        #mainmenu ul li ul li:last-child {
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        #mainmenu ul li ul li a {
            padding: 10px 15px;
            border: none
        }

        /*************************** Выпадающие пункты второго уровня **/

        #mainmenu ul li ul li ul {
            top: 0;
            left: 90%;
            margin: 0 0 0 20px;
            _margin: 0;
            /*IE6 only*/
            box-shadow: -1px 0 0 rgba(255, 255, 255, .3);
            -moz-box-shadow: -1px 0 0 rgba(255, 255, 255, .3);
            -o-box-shadow: -1px 0 0 rgba(255, 255, 255, .3);
            -ms-box-shadow: -1px 0 0 rgba(255, 255, 255, .3);
            -webkit-box-shadow: -1px 0 0 rgba(255, 255, 255, .3);
        }

        /** Индикатор наличия подкатегорий 2 уровня **/

        #mainmenu > ul > li ul li.parent > a::after {
            border-left: 1px solid #CCC;
            border-top: 1px solid #CCC;
            content: "";
            display: inline-block;
            vertical-align: top;
            margin: 7px 0px 0px 8px;
            -webkit-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            -o-transform: rotate(135deg);
            transform: rotate(135deg);
            height: 5px;
            width: 5px;
            float: right;
        }

        /********************** Стрелочки на подпунктах **/

        #mainmenu ul ul li:first-child > a {
            border-radius: 3px 3px 0 0;
            -moz-border-radius: 3px 3px 0 0;
            -o-border-radius: 3px 3px 0 0;
            -ms-border-radius: 3px 3px 0 0;
            -webkit-border-radius: 3px 3px 0 0;
        }
        #mainmenu ul li > ul > li:first-child > a:before {
            content: '';
            position: absolute;
            left: 40px;
            top: -6px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #444;
        }
        #mainmenu ul ul ul li:first-child a:before {
            left: -6px;
            top: 50%;
            margin-top: -6px;
            border-left: 0;
            border-bottom: 6px solid transparent;
            border-top: 6px solid transparent;
            border-right: 6px solid #3b3b3b;
        }
        #mainmenu ul ul li:first-child a:hover:before {
            border-bottom-color: #04acec
        }
        #mainmenu ul ul ul li:first-child a:hover:before {
            border-right-color: #0299d3;
            border-bottom-color: transparent;
        }
        #mainmenu ul ul li:last-child > a {
            -moz-border-radius: 0 0 3px 3px;
            -webkit-border-radius: 0 0 3px 3px;
            border-radius: 0 0 3px 3px;
        }
        #mainmenu > ul > li.parent > ul > li:first-child > a::before {
            display: none;
        }
        #mainmenu > ul > li.parent > a::before {
            bottom: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #444;
            content: '';
            visibility: hidden;
            position: absolute;
            left: 50%;
            margin-left: -6px;
        }
        #mainmenu > ul > li.parent:hover > a::before {
            visibility: visible;
            -webkit-transition: all .5s ease .2s;
            -moz-transition: all .5s ease .2s;
            -o-transition: all .5s ease .2s;
            transition: all .5s ease .2s;
        }
    </style>
@stop