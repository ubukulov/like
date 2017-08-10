@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Форма редактирование основного прайса
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/opt_price/update') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="count" value="1" name="count"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="id_opt_price_cat">Выберите категории</label>
                                <select id="id_opt_price_cat" class="form-control" name="id_opt_price_cat[]" multiple="multiple" required>
                                    @foreach($opt_cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_partner">Выберите партнер</label>
                                <select id="id_partner" name="id_partner" class="form-control">
                                @foreach ($opt_partners as $partner)
                                    @if($partner->id == $opt_price->id_partner)
                                        <option value="{{ $partner->id }}" selected="selected">{{ $partner->title }}</option>
                                    @else
                                        <option value="{{ $partner->id }}">{{ $partner->title }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>

                            <hr>
                            <h4><strong>Загрузить прайс</strong></h4><br>
                            <div class="row uploadPrice" id="uploadPrice1">

                                <div class="col-md-1">
                                    <label for="number1">ID</label>
                                    <span class="form-control">{{ $opt_price->id }}</span>
                                </div>

                                <div class="col-md-3">
                                    <label for="title1">Название</label>
                                    <input type="text" id="title1" value="{{ $opt_price->title }}" class="form-control" name="title1" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="count_type1">Количество видов</label>
                                    <input type="text" id="count_type1" value="{{ $opt_price->count_type }}" class="form-control" name="count_type1" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="excel1">Файл</label><br>
                                    @if(!empty($opt_price->file))
                                    <a href="{{ asset('uploads/opt_price/files/'.$opt_price->file) }}">Просмотр</a>
                                    @else
                                    <input type="file" id="excel1" name="excel1" class="excel form-control" required>
                                    @endif
                                </div>


                            </div>

                            <br>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
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