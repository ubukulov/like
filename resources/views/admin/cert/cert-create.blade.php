@extends('admin/layout/default')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Форма добавление задании
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/cert/store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" name="id_pod_cat" id="id_pod_cat" value="0">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Список категории</label>
                                <select class="form-control select2" onchange="get_cats('id_main_cat','id_pod_cat1');" style="width: 100%;" id="id_main_cat" name="id_main_cat">
                                    <option value="">-- Выберите --</option>
                                    @foreach($cats as $c)
                                        <option value="{{ $c->id }}">{{ $c->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>1-уровень категории</label>
                                <select class="form-control select2" style="width: 100%;" id="id_pod_cat1" onchange="get_cats('id_pod_cat1','id_pod_cat2');">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>2-уровень категории</label>
                                <select class="form-control select2" style="width: 100%;" id="id_pod_cat2" onchange="get_cats('id_pod_cat2','id_pod_cat3');" >

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>3-уровень категории</label>
                                <select class="form-control select2" style="width: 100%;" id="id_pod_cat3" onchange="get_cats('id_pod_cat3');" >

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Выберите тип</label>
                            <select name="cert_type" id="cert_type" class="form-control">
                                <option value="1">Задания</option>
                                <option value="2">Бизнес</option>
                                <option value="3">Купон</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" class="form-control" id="title" required="required" name="title" placeholder="Введите название">
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="date_start">Дата начала</label>--}}
                            {{--<input type="text" class="form-control" id="date_start" name="date_start" required="required">--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="date_end">Дата конца</label>--}}
                            {{--<input type="text" class="form-control" id="date_end" name="date_end" required="required">--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="special2">Цена без скидки</label>
                            <input type="text" class="form-control" id="special2" name="special2" placeholder="Цена без скидки"/>
                        </div>

                        <div class="form-group">
                            <label for="special3">Цена со скидкой</label>
                            <input type="text" class="form-control" id="special3" name="special3" placeholder="Цена со скидкой" />
                        </div>

                        <div class="form-group">
                            <label for="prime_cost">Себестоимость товара</label>
                            <input type="text" class="form-control" id="prime_cost" name="prime_cost" placeholder="Себестоимость товара" />
                        </div>

                        <div class="form-group">
                            <label for="count">Количество товара</label>
                            <input type="text" class="form-control" id="count" name="count" placeholder="Количество товара" />
                        </div>

                        <div class="form-group">
                            <label>Список партнеров</label>
                            <select class="form-control select2" style="width: 100%;" name="id_partner">
                                @foreach($partner as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Выберите раздел</label>
                            <select name="section_type" id="section_type" class="form-control" style="cursor: pointer;">
                                <option value="0">Не указыно</option>
                                <option value="1">Хиты продаж</option>
                                <option value="2">Популярные</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Выберите ярлык к товару</label>
                            <select name="label_type" id="label_type" class="form-control" style="cursor: pointer;">
                                <option value="0">Не указыно</option>
                                <option value="1">Хиты продаж</option>
                                <option value="2">Товар дня</option>
                                <option value="3">Лучший выбор</option>
                                <option value="4">Низкая цена</option>
                                <option value="5">Акционный</option>
                                <option value="6">Лучший подарок</option>
                            </select>
                        </div>
                        <hr>
                        <h3>Настройки оптовой цены</h3>
                        <input type="hidden" id="cnt" value="1" name="cnt"/>
                        <div class="row uploadPrice" id="uploadPrice1">

                            <div class="col-md-2">
                                <label for="number1">№</label>
                                <span class="form-control">1</span>
                            </div>

                            <div class="col-md-2">
                                <label for="from">от</label>
                                <input type="text" id="from1" class="form-control int" name="from1" required>
                            </div>

                            <div class="col-md-2">
                                <label for="to1">до</label>
                                <input type="text" id="to1" class="form-control int" name="to1" required>
                            </div>

                            <div class="col-md-4">
                                <label for="sum1">сумма</label>
                                <input type="text" id="sum1" class="form-control int" name="sum1" required>
                            </div>

                            <div class="col-md-2">

                            </div>

                        </div>
                        <div id="createUploadButton" class="row" style="margin-top: 40px;">
                            <div class="col-md-12" style="border-top: 1px solid #ccc;">
                                <button type="button" style="margin-top: 10px;" class="btn btn-bitbucket" onclick="createOptom();">еще добавить</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <label for="article_code">Код товара</label>
                        <input type="text" class="form-control" id="article_code" name="article_code">
                    </div>

                    <div class="form-group">
                        <label for="b1">Бизнес1</label>
                        <input type="text" class="form-control" id="b1" name="b1" placeholder="Бизнес1" />
                    </div>

                    <div class="form-group">
                        <label for="b2">Бизнес2</label>
                        <input type="text" class="form-control" id="b2" name="b2" placeholder="Бизнес2" />
                    </div>

                    <div class="form-group">
                        <label for="b3">Бизнес3</label>
                        <input type="text" class="form-control" id="b3" name="b3" placeholder="Бизнес3" />
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label for="special1">Вознаграждение</label>--}}
                        {{--<input type="text" class="form-control" id="special1" name="special1" placeholder="Введите вознаграждение">--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label for="special4">special4</label>
                        <input type="text" class="form-control" id="special4" name="special4" placeholder="special4" />
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label for="old_price">Старая цена</label>--}}
                        {{--<input type="text" class="form-control" id="old_price" name="old_price" placeholder="old_price" />--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label for="economy">economy</label>
                        <input type="text" class="form-control" id="economy" name="economy" placeholder="economy" />
                    </div>

                    <div class="form-group">
                        <label for="sort">Сортировка</label>
                        <input type="text" class="form-control" id="sort" name="sort" placeholder="сортировка" />
                    </div>

                    <div class="form-group">
                        <label for="meta_description">Короткое описание</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="meta_description" />
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords">Ключевые слова</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="meta_keywords" />
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="image1">
                                <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                            </div>
                            <br>
                            <button id="upload1" class="blue">Выбрать картинку 1</button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="image2">
                                <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image2">
                            </div>
                            <br>
                            <button id="upload2" class="blue">Выбрать картинку 2</button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div id="image3">
                                <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image3">
                            </div>
                            <br>
                            <button id="upload3" class="blue">Выбрать картинку 3</button>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="conditions">Условия</label>
                        <textarea id="conditions" class="form-control wysiwyg" name="conditions"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="features">Описание</label>
                        <textarea id="features" class="form-control wysiwyg" name="features"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Полные описание</label>
                        <textarea id="description" class="form-control wysiwyg" name="description"></textarea>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </form>
    </div>
</section>
@stop