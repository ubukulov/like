@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список пользователей
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h3>Используйте поиск</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="phone" class="form-control" placeholder="Введите телефон" style="width: 150px;">
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" onclick="search_by_phone();" style="margin-left: 20px;" class="btn btn-success">Поиск</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="card_number" class="form-control" placeholder="Карта" style="width: 150px;">
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" onclick="search_by_card();" style="margin-left: 20px;" class="btn btn-success">Поиск</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="firstname" class="form-control" placeholder="Фамилия" style="width: 150px;">
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" style="margin-left: 20px;" class="btn btn-success">Поиск</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="text" id="lastname" class="form-control" placeholder="Имя" style="width: 150px;">
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" style="margin-left: 20px;" class="btn btn-success">Поиск</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Реферал</th>
                                <th>Имя</th>
                                <th>Статус</th>
                                <th>Телефон</th>
                                <th>Авторизация</th>
                                <th>Номер карты</th>
                                <th>Баланс</th>
                                <th>Дата регистрации</th>
                            </tr>
                            </thead>
                            <tbody id="user_content">
                            <?php foreach($users as $user) :?>
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->referral }}
                                </td>
                                <td>
                                    <a href="#">
                                        @if($user->avatar)
                                        <img src="{{ asset('uploads/users/small/'.$user->avatar) }}" alt="" height="40" width="40" />
                                        @else
                                        <img src="{{ asset('img/blank_avatar_220.png') }}" alt="" height="40" width="40" />
                                        @endif
                                        {{ $user->firstname . " " .$user->lastname }}
                                    </a>
                                </td>
                                <td>

                                </td>
                                <td>
                                    {{ $user->mphone }}
                                </td>
                                <td>
                                    <button class="blue" >войти</button>
                                </td>
                                <td>
                                    {{ getCardNumberByUserID($user->id) }}
                                </td>
                                <td>
                                    {{ __decode($user->fm, env('KEY')) }}
                                </td>
                                <td>
                                    @if(!empty($user->reg_date))
                                    {{ date('d.m.Y H:i:s', $user->reg_date) }}
                                    @else
                                    {{ $user->created_at }}
                                    @endif
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $users->links() }}
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop