@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Обновление цены
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">

                        <h4>Требование к файлу</h4>

                        <span>Формат файла: *.xls</span><br>
                        <span>Порядок колонок: 1) Артикул товара; 2) Наименование; 3) Производитель (Бренд); 4) Розничная цена; 5) Себестоимость;</span> <br>
                        <span>Все данные должны начинаться с 2 строка. 1 строке находится название колонок</span> <br>

                        <form action="{{ url('admin/upgrade/price') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-top: 50px;">
                                <label for="file" class="col-sm-2 control-label">Выбор файла</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 50px;">
                                <label for="file" class="col-sm-2 control-label">Выбор поставщика (если нет нужно добавить через админку)</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="partner_id">
                                        @foreach($partners as $pt)
                                            <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="submit" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Обновить цены</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!!Session::get('message')!!}
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
    </section>
@stop