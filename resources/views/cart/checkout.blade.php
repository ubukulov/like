@extends('layouts.cart')
@section('content')
    <div class="" style="width: 80%; margin: 20px auto;">

        <?php if(isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) :?>
        <form method="post" action="{{ url('/store/order') }}">
            {{ csrf_field() }}
            <div class="checkout-holder">
                <div class="table-responsive table-checkout">
                    <h3><strong>Оформление заказа</strong></h3>
                    <hr><br>
                    <h6><span class="shipping-label">Итого: {{ $_SESSION['total_quantity'] }} товар(-ов) на сумму <span style="font-weight: bold;"><?=$_SESSION['total_sum']?> тг</span></span></h6>
                    <table class="table">
                        <tbody>
                        <?php foreach($_SESSION['cart'] as $key=>$val) :?>
                        <tr>
                            <td class="col-lg-5 td">
                                <a href="{{ url('/item/'.$val['id']) }}">
                                    @if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$val['img']) AND !empty($val['img']))
                                        <img class="cart_img" width="100" src="{{ asset('uploads/certs/'.$val['img']) }}" alt="">
                                    @else
                                        <img class="cart_img" width="100" src="{{ asset('img/no_photo227x140.png') }}" alt="">
                                    @endif
                                </a>
                                <a href="{{ url('/item/'.$val['id']) }}"><span class="product-desc-alt"><?=$val['title'];?></span></a>
                            </td>

                            <td class="td">
                                <div class="quantity">
                                    <input style="width: 80px; text-align: center;" class="input-text qty text form-control cart_input2" id="qty<?=$key;?>" type="text" value="<?=$val['qty'];?>">
                                </div>
                            </td>

                            <td class="td">
                                @if(isset($_SESSION['cart'][$val['id']]['opt_price']))
                                    <span style="text-decoration: line-through;"><?=$val['price'];?> тг</span><br>
                                    <strong><span>{{ $_SESSION['cart'][$val['id']]['opt_price'] }} тг</span></strong>
                                @else
                                <strong><?=$val['price'];?> тг</strong>
                                @endif
                            </td>

                            <td>
                                <div class="inline field" style="padding-top: 5px;">
                                    <div class="ui checkbox">
                                        <input type="hidden" id="item{{ $val['id'] }}" value="{{ $val['id'] }}">
                                        <input type="checkbox" @if(isset($_SESSION['cart'][$val['id']]['opt_price'])) checked="checked" @endif id="opt{{ $val['id'] }}" tabindex="0" class="opt_price">
                                        <label style="font-size: 14px;">Оптом</label>
                                    </div>
                                </div>
                            </td>

                            <td class="td">
                                <div class="text-center" style="color: navy">
                                    {{--<a href="{{ url('/cart/delete/'.$key) }}" style="color: navy"><img src="{{ asset('img/delete_icon.png') }}" alt="delete"></a>--}}
                                    <a href="{{ url('/cart/delete/'.$key) }}" title="удалить" style="color: navy"><i class="fa fa-trash-o red" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br>
                    <h3><strong>Способ получения</strong></h3>
                    <hr>
                    <input type="hidden" id="delivery" name="delivery" value="1">
                    <button type="button" id="btn_cureer" class="cart_btn cart_btn_left" style="float: left;">Доставка курьером</button>
                    <button type="button" id="my_self" class="cart_btn2 cart_btn_left2" style="float: left;">Самовывоз</button>
                    <br><br>
                    <div id="dostavka_kurerom">
                        <p style="margin-top: 20px;">
                            Сегодня или завтра, в любое время, <strong>500тг</strong></p>
                        <p>Для точности с Вами свяжется наш оператор</p>
                    </div>
                    <div id="samo_vivoz" style="display: none;">
                        <p style="margin-top: 20px;">
                            Пункт выдачи <br>
                            <strong>г. Алматы</strong>, Гоголя 13, уг. Барибаева, 1 подъезд, цокольный этаж<br>
                            С 9:00 – 21:00, без выходных <br>
                        </p>
                    </div>
                    <br>
                </div>
                <h3><strong>Данные покупателя</strong></h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control centered-form" id="client_name" name="client_name" placeholder="Имя" type="text">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control centered-form" id="inputEmail" name="email" placeholder="E-mail" type="email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control centered-form phone" id="phone" name="phone" required="required" placeholder="Моб. Телефон" type="text">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3" placeholder="Адрес доставки и комментарии к заказу"></textarea>
                        </div>
                    </div>
                </div>
            </div><!-- Checkout / End -->

                    <div class="">
                        <h3><strong>Способ оплаты</strong></h3>
                    </div>
                    <hr>
                    <div class="ui form">
                        <div class="inline fields">
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="status" value="1" onchange="payment(1);">
                                    <label style="font-size: 13px;">Со счета Likemoney</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="status" value="4" checked="checked" onchange="payment(4);">
                                    <label style="font-size: 13px;">Наличными при получении</label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="status" value="5" onchange="payment(5);">
                                    <label style="font-size: 13px;">Оплата в офисе</label>
                                </div>
                            </div>

                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="status" value="2" onchange="payment(2);">
                                    <label style="font-size: 13px;">QIWI терминалы</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="status" value="3" onchange="payment(3);">
                                    <label style="font-size: 13px;">Visa/Mastercard</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--<div class="row marginBottom40">--}}
                        {{--<div class="col-sm-3 col-xs-6 no-padding">--}}
                            {{--<div style="float:left; margin-right:5px; margin-top:5px; margin-bottom:10px;">--}}
                                {{--<input name="status" type="radio" value="1" checked="checked"  onchange="payment(1);">--}}
                            {{--</div><font class="sm-text">Со счета Likemoney</font><br>--}}
                            {{--<img class="card" src="{{ asset('img/card.png') }}" style="width:80px">--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3 col-xs-6 no-padding">--}}
                            {{--<div style="float:left; margin-right:5px; margin-top:5px; margin-bottom:10px;">--}}
                                {{--<input name="status" type="radio" value="4" onchange="payment(4);">--}}
                            {{--</div><font class="sm-text">Курьеру наличными</font><br>--}}
                            {{--<img class="card" src="{{ asset('img/nalichnie.jpg') }}" style="width:63px">--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3 col-xs-6 no-padding">--}}
                            {{--<div style="float:left; margin: 5px 5px 10px 15px;">--}}
                                {{--<input name="status" type="radio" value="2" onchange="payment(2);">--}}
                            {{--</div><font class="sm-text">QIWI терминалы</font><br>--}}
                            {{--<img class="card" src="{{ asset('img/qiwi.png') }}" style="width:80px">--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3 col-xs-6 no-padding">--}}
                            {{--<div style="float:left; margin: 5px 5px 10px 15px;">--}}
                                {{--<input name="status" type="radio" value="3"  onchange="payment(3);">--}}
                            {{--</div><font class="sm-text">Visa/Mastercard</font><br>--}}
                            {{--<img class="card" src="{{ asset('img/visa.png') }}" style="width:80px">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <br>
                    <div class="payment-footer">
                        <div class="btn-confirm-holder">
                            <button id="pay" class="btn btn-success" style="width: 200px; background: #FFDB4D; border: 1px solid #FFDB4D; color: #000;" type="submit" name="submit">Отправить заказ</button>
                        </div>
                    </div>
                    <div id="qiwi" style="display: none;">
                        <pre-pay>
                            Инструкция по пополнению баланса Likemoney.me через терминалы Qiwi:
                            <br><br>
                            1. Найдите ближайший терминал Qiwi посмотреть на карте (<a href="https://goo.gl/Je7c3m" target="_blank">https://goo.gl/Je7c3m</a>) <br>
                            2. Нажмите кнопку "Оплата услуг" <br>
                            3. Выберите "Онлайн: игры, сайты, деньги" <br>
                            4. Нажмите кнопку "Скидки и купоны" <br>
                            5. Выберите "Likemoney.me" <br>
                            6. Укажите удобный способ пополнения "Номер карты или мобильного" <br>
                            7. Внесите необходимую сумму <br>
                            8. Деньги поступят к Вам на баланс в личном кабинете <br>
                            9. Совершайте покупки со скидкой от 50 до 100%. <br>

                            <br>
                            Пополните баланс быстрее через "Поиск": <br><br>

                            1. Найдите ближайший терминал Qiwi <br>
                            2. Нажмите кнопку "Оплата услуг" <br>
                            3. В правом нижнем углу нажмите на кнопку "Поиск" <br>
                            4. Введите название "Likemoney.me" и нажмите по нему <br>
                            5. Укажите удобный способ пополнения "Номер карты или мобильного" <br>
                            6. Внесите необходимую сумму <br>
                            7. Деньги поступят к Вам на баланс в личном кабинете <br>
                            8. Совершайте покупки со скидкой от 50 до 100%.
                        </pre-pay>
                    </div>
        </form>
        <?php elseif(isset($_SESSION['order'])) :?>
        <div style="width: 700px; margin: 0 auto;">
            <div style="border: 3px solid #424242; text-align: center;">
                <h4 style="color: #00a100; font-size: 20px;">SMS сертификат с кодом для активации успешно отправлен клиенту.</h4>
                <h4 style="color: #424242; font-size: 20px;">Ваш доход поступит к Вам на счет после активации сертификата.</h4>
            </div>
            <br>
            <div style="text-align: center; margin-bottom: 40px;">
                <a style="color: #1b6d85;" href="/">перейти на главную</a>
            </div>
        </div>
        <?php else :?>
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @else
            Корзина пуста
        @endif
        <?php endif; ?>
    </div>
@stop