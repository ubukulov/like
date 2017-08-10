@extends('partner.layout.partner')
@section('content')
    <div style="float:right;">
        <button type="button" class="btn-edit-user">
            <i class="fa fa-book fa-2"></i>&nbsp;&nbsp; Архив заданий
        </button>
    </div>
    <div class="blog-heading">
        <h3>Ваши задания</h3>
    </div>

    <hr />
    <table width="100%">
        <tr>
            <td><font style="color:#0099CC"><i class="fa fa-users"></i></font>&nbsp;&nbsp;Исполнители: 0</td>
            <td><font style="color:#619F05"><i class="fa fa-thumbs-up"></i></font>&nbsp;&nbsp;Выполнено заданий: 0</td>
            <td>Всего заданий: {{ $cert_count }}</td>
        </tr>
    </table>
    <hr />

    <div class="row">

        <? foreach ($certs as $cert): ?>
        <div class="col-sm-3 col-xs-6">
            <div class="brd">
                <div class="portfolio-item">
                    <!-- /.portfolio-img -->
                    <div class="portfolio-img" style="height: 140px;">
                        <img src="{{ asset('uploads/certs/small/'.$cert->image) }}" alt="port-1" class="port-item">
                        <div class="portfolio-img-hover">
                            <a href="task?id=<?=$cert->id?>">
                                <img src="{{ asset('img/plus.png') }}" alt="plus" class="plus">
                            </a>
                        </div>
                        <!-- /.portfolio-img-hover -->
                    </div>
                    <div class="portfolio-item-details">
                        <div class="portfolio-item-name"><?= $cert->title; ?></div>
                        <!-- /.portfolio-item-name -->
                        <div style="float: left;">
                            <table>
                                <tbody>
                                <tr>
                                    <td align="center"><font color="#62A005" size="4"><i class="fa fa-credit-card-alt"></i></font></td>
                                    <td style="padding-left:7px; line-height: 15px;"><small>Оплата:<br><font color="#62A005"><b>0 тг</b></font></small></td>
                                    <td style="padding-left:15px;" align="center">
                                        <a href="task?id=<?=$cert->id?>" type="button" class="hidden-xs taskbutton">Подробнее</a>
                                    </td>
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

        <? endforeach; ?>

    </div>
    <hr />
    {{ $certs->links() }}
@stop