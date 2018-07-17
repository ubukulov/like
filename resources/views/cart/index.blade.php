@extends('layouts.cart')
@section('content')
    <div class="" style="width: 80%; margin: 20px auto;">

        <?php if(isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) :?>
        <form method="post" action="{{ url('/cart/order') }}">
            {{ csrf_field() }}
            <div class="checkout-holder">
                <div class="table-responsive table-checkout">
                    <table class="table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>Корзина</th>
                            <th>Количество</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                        </thead>
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
                                <strong><?=number_format($val['price'],0,' ',' ');?> тг</strong>
                            </td>
                            <td class="td">
                                <div class="text-center" style="color: navy">
                                    {{--<a href="{{ url('/cart/delete/'.$key) }}" style="color: navy"><img src="{{ asset('img/delete_icon.png') }}" alt="delete"></a>--}}
                                    <a href="{{ url('/cart/delete/'.$key) }}" style="color: navy"><i class="fa fa-trash-o red" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="shipping-subtotal">
                            <td colspan="2" class="td"><span class="shipping-label">Итого: {{ $_SESSION['total_quantity'] }} товар(-ов) на сумму <span style="font-weight: bold;"><?=number_format($_SESSION['total_sum'],0,' ',' ')?> тг</span></span></td>
                            <td colspan="2" class="td" style="text-align: center;">
                                <a href="{{ url('/cart/checkout') }}" class="btn btn-success" style="width: 200px; background: #FFDB4D; border: 1px solid #FFDB4D; color: #000;">Оформить заказ</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- Checkout / End -->

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
                {!! Session::get('message') !!} <br>

                <p>Заказ будет доставлен быстрее, если Вы уведомите поставщика о заказе по WhatsApp</p> <br>'
                <a href="https://api.whatsapp.com/send?phone={{ $_SESSION['store_user_phone_whatsapp'] }}&text=Здравствуйте!%20Я%20хотел%20бы%20узнать%20цену%20по%20товару%20'<?php echo $cert->title; ?>'!.%20%20Спасибо!%20Код товара:%20<?php echo $cert->article_code; ?>%20Товар%20по%20этому%20адресу:%20http://likemoney.me/item/<?php echo $cert->id ?>" target="_blank"><img src="/img/whatsapp_button.png" /></a>
            @else
                Корзина пуста
            @endif
        <?php endif; ?>
    </div>
@stop