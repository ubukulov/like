@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Партнеры: начисления
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!!Session::get('message')!!}
                            </div>
                        @endif
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Партнер</th>
                                <th>Предложение</th>
                                <th>Задание</th>
                                <th>Карта</th>
                                <th>Пользователь</th>
                                <th>Сумма</th>
                                <th>Сумма снятия</th>
                                <th>Кол-во</th>
                                <th>Статус</th>
                                <th>Отменить</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($charges as $charge) :?>
                            <tr>
                                <td>
                                    {{ $charge->id }}
                                </td>
                                <td>
                                    <?php
                                    $partner = getPartner($charge->partner_id);
                                    if(!empty($partner->image)){
                                        echo "<img src='/uploads/partners/small/".$partner->image."' height='40' width='40' /> &nbsp;&nbsp;".$partner->name;
                                    }else{
                                        echo "<img src='/img/blank_avatar_220.png' height='40' width='40' /> &nbsp;&nbsp;".$partner->name;
                                    }
                                    ?>
                                </td>
                                <td>
                                    {{ $charge->cert_sub_id }}
                                </td>
                                <td>
                                    {{ $charge->cert_id }}
                                </td>
                                <td>
                                    {{ $charge->card }}
                                </td>
                                <td>
                                    <?php
                                    $user = getUserData($charge->user_id);
                                    if(!empty($user->avatar)){
                                        echo "<img src='/uploads/users/small/".$user->avatar."' height='40' width='40' /> &nbsp;&nbsp;".$user->firstname.' '.$user->lastname;
                                    }else{
                                        echo "<img src='/img/blank_avatar_220.png' height='40' width='40' /> &nbsp;&nbsp;".$user->firstname.' '.$user->lastname;
                                    }
                                    ?>
                                </td>
                                <td>
                                    {{ $charge->sum }} тг
                                </td>
                                <td>
                                    {{ $charge->sum_minus }} тг
                                </td>
                                <td>
                                    {{ $charge->count }}
                                </td>
                                <td>
                                    @if($charge->status == 1)
                                    Фикс. начисление
                                    @elseif($charge->status == 2)
                                    % начисление
                                    @elseif($charge->status == 11)
                                    Возврат Фикс. начисление
                                    @elseif ($charge->status == 12)
                                    Возврат % начисление
                                    @endif
                                </td>
                                <td>
                                    @if($charge->status < 10)
                                    <button onclick="return_pay_to_user(<?= $charge->id ?>)" class="btn btn-bitbucket">возврат</button>
                                    @endif
                                </td>
                                <td>
                                    {{ date('d.m.Y H:i:s', $charge->date) }}
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $charges->links() }}
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop