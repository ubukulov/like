@extends('admin/layout/default')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Форма редактирование задании
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/cert/'.$cert->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <input type="hidden" name="id_pod_cat" id="id_pod_cat" value="{{ $cert->pod_cat }}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Список категории</label>
                                    <select class="form-control select2" onchange="get_cats('id_main_cat','id_pod_cat1');" style="width: 100%;" id="id_main_cat" name="id_main_cat">
                                        <option value="">-- Выберите --</option>
                                        @foreach($cats as $c)
                                            @if($cert->category_id == $c->id)
                                                <option value="{{ $c->id }}" selected="selected">{{ $c->title }}</option>
                                            @else
                                                <option value="{{ $c->id }}">{{ $c->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>1-уровень категории</label>
                                    <select class="form-control select2" style="width: 100%;" id="id_pod_cat1" onchange="get_cats('id_pod_cat1','id_pod_cat2');">
                                        <option value="0">{{ check_pod_cat1($cert->pod_cat) }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>2-уровень категории</label>
                                    <select class="form-control select2" style="width: 100%;" id="id_pod_cat2" onchange="get_cats('id_pod_cat2','id_pod_cat3');" >
                                        <option value="0">{{ check_pod_cat2($cert->pod_cat) }}</option>
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
                                <option value="1" @if($cert->cert_type == 1) selected="selected" @endif>Задания</option>
                                <option value="2" @if($cert->cert_type == 2) selected="selected" @endif>Бизнес</option>
                                <option value="3" @if($cert->cert_type == 3) selected="selected" @endif>Купон</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" class="form-control" id="title" value="{{ $cert->title }}" required="required" name="title" placeholder="Введите название">
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label>Список категории</label>--}}
                            {{--<select class="form-control select2" style="width: 100%;" id="id_main_cat" name="id_main_cat">--}}
                                {{--@foreach($cats as $c)--}}
                                    {{--@if($cert->id_main_cat == $c->id)--}}
                                    {{--<option value="{{ $c->id }}" selected="selected">{{ $c->title }}</option>--}}
                                    {{--@else--}}
                                    {{--<option value="{{ $c->id }}">{{ $c->title }}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label>Список под категории</label>--}}
                            {{--<select class="form-control select2" style="width: 100%;" id="id_pod_cat" name="id_pod_cat">--}}
                                {{--@foreach($pod_cat as $pc)--}}
                                    {{--@if($cert->id_pod_cat == $pc->id)--}}
                                    {{--<option value="{{ $pc->id }}">{{ $pc->title }}</option>--}}
                                    {{--@else--}}
                                    {{--<option value="{{ $pc->id }}">{{ $pc->title }}</option>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="date_start">Дата начала</label>
                            <input type="text" class="form-control" id="date_start" value="{{ date("d.m.Y", $cert->date_start) }}" name="date_start" required="required">
                        </div>

                        <div class="form-group">
                            <label for="date_end">Дата конца</label>
                            <input type="text" class="form-control" id="date_end" value="{{ date("d.m.Y", $cert->date_end) }}" name="date_end" required="required">
                        </div>

                        <div class="form-group">
                            <label for="special2">Цена без скидки</label>
                            <input type="text" class="form-control" id="special2" name="special2" value="{{ $cert->special2 }}" placeholder="Цена без скидки"/>
                        </div>

                        <div class="form-group">
                            <label for="special3">Цена со скидкой</label>
                            <input type="text" class="form-control" id="special3" value="{{ $cert->special3 }}" name="special3" placeholder="Цена со скидкой" />
                        </div>

                        <div class="form-group">
                            <label for="special3">Себестоимость товара</label>
                            <input type="text" class="form-control" id="prime_cost" value="{{ $cert->prime_cost }}" name="prime_cost" placeholder="Себестоимость товара" />
                        </div>

                        <div class="form-group">
                            <label for="count">Количество товара</label>
                            <input type="text" class="form-control" id="count" value="{{ $cert->count }}" name="count" placeholder="Количество товара" />
                        </div>

                        <div class="form-group">
                            <label>Список партнеров</label>
                            <select class="form-control select2" style="width: 100%;" name="id_partner">
                                @foreach($partner as $pt)
                                    @if($cert->partner_id == $pt->id)
                                        <option value="{{ $pt->id }}" selected="selected">{{ $pt->name }}</option>
                                    @else
                                        <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <h3>Настройки оптовой цены</h3>
                        <input type="hidden" id="cnt" value="0" name="cnt"/>
                        @foreach($opt as $item)
                        <div class="row uploadPrice" id="uploadPrice1">
                            <?php
                                if(!isset($_SESSION['opt']['is'])){
                                    $_SESSION['opt']['is'] = 1;
                                    $_SESSION['opt'][] = $item->id;
                                }else{
                                    $_SESSION['opt'][] = $item->id;
                                }
                            ?>
                            <div class="col-md-2">
                                <label for="number{{ $item->id }}">ID</label>
                                <span class="form-control">{{ $item->id }}</span>
                            </div>

                            <div class="col-md-2">
                                <label for="from{{ $item->id }}">от</label>
                                <input type="text" id="from{{ $item->id }}" class="form-control int" value="{{ $item->nach }}" name="from{{ $item->id }}" required>
                            </div>

                            <div class="col-md-2">
                                <label for="to{{ $item->id }}">до</label>
                                <input type="text" id="to{{ $item->id }}" class="form-control int" value="{{ $item->kon }}" name="to{{ $item->id }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="sum{{ $item->id }}">сумма</label>
                                <input type="text" id="sum{{ $item->id }}" class="form-control int" value="{{ $item->summa }}" name="sum{{ $item->id }}" required>
                            </div>

                            <div class="col-md-2">
                                <div class="col-md-2">
                                    <label for="number1">удалить</label>
                                    <button type="button" onclick="deleteOptomBD({{ $item->id }}, {{ $cert->id }});" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                            <input type="text" class="form-control" id="article_code" name="article_code" value="{{ $cert->article_code }}">
                        </div>

                        <div class="form-group">
                            <label for="b1">Бизнес1</label>
                            <input type="text" class="form-control" id="b1" name="b1" value="{{ $cert->b1 }}" placeholder="Бизнес1" />
                        </div>

                        <div class="form-group">
                            <label for="b2">Бизнес2</label>
                            <input type="text" class="form-control" id="b2" name="b2" value="{{ $cert->b2 }}" placeholder="Бизнес2" />
                        </div>

                        <div class="form-group">
                            <label for="b3">Бизнес3</label>
                            <input type="text" class="form-control" id="b3" name="b3" value="{{ $cert->b3 }}" placeholder="Бизнес3" />
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="special1">Вознаграждение</label>--}}
                            {{--<input type="text" class="form-control" id="special1" name="special1" value="{{ $cert->special1 }}" placeholder="Введите вознаграждение">--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="special4">special4</label>
                            <input type="text" class="form-control" id="special4" name="special4" value="{{ $cert->special4 }}" placeholder="special4" />
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="old_price">Старая цена</label>--}}
                            {{--<input type="text" class="form-control" id="old_price" name="old_price" value="{{ $cert->old_price }}" placeholder="old_price" />--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="economy">economy</label>
                            <input type="text" class="form-control" id="economy" name="economy" value="{{ $cert->economy }}" placeholder="economy" />
                        </div>

                        <div class="form-group">
                            <label for="sort">Сортировка</label>
                            <input type="text" class="form-control" id="sort" name="sort" value="{{ $cert->sort }}" placeholder="сортировка" />
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Короткое описание</label>
                            <input type="text" class="form-control" id="meta_description" value="{{ $cert->meta_description }}" name="meta_description" placeholder="meta_description" />
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Ключевые слова</label>
                            <input type="text" class="form-control" id="meta_keywords" value="{{ $cert->meta_keywords }}" name="meta_keywords" placeholder="meta_keywords" />
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
                                    @if(!empty($cert->image))
                                    <img  src="{{ asset('uploads/certs/'.$cert->image) }}" height="100">
                                    <input type="hidden" name="photo1" value="{{ $cert->image }}" />
                                    @else
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100">
                                    @endif
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать картинку 1</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div id="image2">
                                    @if(!empty($cert->image2))
                                        <img  src="{{ asset('uploads/certs/'.$cert->image2) }}" height="100">
                                        <input type="hidden" name="photo2" value="{{ $cert->image2 }}" />
                                    @else
                                        <img src="{{ asset('img/no_thumb.png') }}"  height="100">
                                    @endif
                                </div>
                                <br>
                                <button id="upload2" class="blue">Выбрать картинку 2</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div id="image3">
                                    @if(!empty($cert->image3))
                                        <img  src="{{ asset('uploads/certs/'.$cert->image3) }}" height="100">
                                        <input type="hidden" name="photo3" value="{{ $cert->image3 }}" />
                                    @else
                                        <img src="{{ asset('img/no_thumb.png') }}"  height="100">
                                    @endif
                                </div>
                                <br>
                                <button id="upload3" class="blue">Выбрать картинку 3</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label for="conditions">Условия</label>
                            <textarea id="conditions" class="form-control wysiwyg" name="conditions">{!! $cert->conditions !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="features">Описание</label>
                            <textarea id="features" class="form-control wysiwyg" name="features">{!! $cert->features !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Полные описание</label>
                            <textarea id="description" class="form-control wysiwyg" name="description">{!! $cert->description !!}</textarea>
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