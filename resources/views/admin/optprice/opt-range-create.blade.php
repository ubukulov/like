@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Форма добавление ассортимента
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/range/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" name="title" id="title" class="form-control" required="required">
                            </div>

                            <label for="price_range">Укажите</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="price_range" id="price_range" class="form-control">
                                        <option value="1">Цена</option>
                                        <option value="2">Ассортимент</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="text" name="price_range_val" id="price_range_val" class="form-control">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group">
                                <div id="image1">
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100">
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать логотип</button>
                            </div>

                            <br>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
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
                                <label for="id_opt_price_cat">Выберите категории</label>
                                <select id="id_opt_price_cat" size="16" class="form-control" name="id_opt_price_cat[]" multiple="multiple" required>
                                    @foreach($opt_cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_partner">Выберите партнер</label>
                                <select id="id_partner" name="id_partner" class="form-control">

                                    @foreach ($opt_partners as $partner)

                                        <option value="{{ $partner->id }}">
                                            {{ $partner->title }}
                                        </option>

                                    @endforeach

                                </select>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

            </div>
        </form>
        @if(Session::has('message'))
            <div class="alert alert-warning">
                {!! Session::get('message') !!}
            </div>
        @endif
    </section>
@stop