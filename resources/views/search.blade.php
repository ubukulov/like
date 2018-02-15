@extends('layouts.app2')
@section('content')
    <div class="row_tsk">
        <div class="row">
            @foreach($search_certs as $key=>$cert)
                <div class="col-md-3">
                    <div class="brd">
                        <div class="portfolio-item">
                            <!-- /.portfolio-img -->
                            <a href="{{ url('/item/'.$cert->id) }}">

                                <div class="portfolio-img" style="height: 160px; cursor: pointer;">
                                    <img @if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/certs/small/'.$cert->image) AND !empty($cert->image)) src="{{ asset('uploads/certs/small/'.$cert->image) }}" @else src="{{ asset('img/no_photo227x140.png') }}" @endif alt="port-1" class="port-item">
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
                                            @if(empty($cert->special3) AND $cert->special3 == 0)
                                                @if(empty($cert->special2))
                                                    <td width="130">
                                                        <a href="https://api.whatsapp.com/send?phone=77758153538&text=Здравствуйте!%20Я%20хотел%20бы%20узнать%20цену%20по%20товару%20'<?php echo $cert->title; ?>'!.%20%20Спасибо!%20Код товара:%20<?php echo $cert->article_code; ?>%20Товар%20по%20этому%20адресу:%20http://likemoney.me/item/<?php echo $cert->id ?>" target="_blank"><img src="/img/whatsapp_button.png" /></a>
                                                    </td>
                                                @else
                                                    <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                                    <td style="width: 130px;padding-left:7px; line-height: 15px;"><small>Цена:<br><font color="#62A005"><b>{{ $cert->special2 }} тг.</b></font></small></td>
                                                @endif
                                            @else
                                                <td width="130">
                                                    <span style="text-decoration: line-through; font-size: 12px;">{{ $cert->special2 }} тг</span><br>
                                                    <span style="color: green; font-weight: bold;">{{ $cert->special3 }} тг</span>
                                                </td>
                                            @endif
                                            @if(is_tariff(Auth::id()))
                                                <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                                @if(check_user_store_tarif(Auth::id()) == '1')
                                                    <td style="padding-left:7px; line-height: 15px;"><small>cashback:<br><font color="#62A005"><b>{{ ($cert->special2 - $cert->prime_cost) * 0.20 }} тг.</b></font></small></td>
                                                @elseif(check_user_store_tarif(Auth::id()) == '2')
                                                    <td style="padding-left:7px; line-height: 15px;"><small>cashback:<br><font color="#62A005"><b>{{ ($cert->special2 - $cert->prime_cost) * 0.30 }} тг.</b></font></small></td>
                                                @else(check_user_store_tarif(Auth::id()) == '3')
                                                    <td style="padding-left:7px; line-height: 15px;"><small>cashback:<br><font color="#62A005"><b>{{ ($cert->special2 - $cert->prime_cost) * 0.50 }} тг.</b></font></small></td>
                                                @endif
                                            @else
                                                <td align="right">
                                                    <a href="{{ url('/item/'.$cert->id) }}" class="hidden-xs taskbutton">Подробнее</a>
                                                </td>
                                            @endif
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
@stop