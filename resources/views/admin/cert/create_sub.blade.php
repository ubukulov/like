@extends('admin/layout/default')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Форма добавление сертификата
        </h1>
    </section>
    <section class="content">
        <form action="{{ url('admin/cert/sub/create') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Товар</label>
                                <select name="cert_id" id="cert_id" class="form-control select2">
                                    @foreach($certs as $cert)
                                        <option value="{{ $cert->id }}">{{ $cert->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Наименование</label>
                                <input type="text" class="form-control" id="title" required="required" name="title" placeholder="Введите название">
                            </div>

                            <div class="form-group">
                                <label for="special2">Цена без скидки</label>
                                <input type="text" class="form-control" id="special2" name="special2" placeholder="Цена без скидки"/>
                            </div>

                            <div class="form-group">
                                <label for="special3">Цена со скидкой</label>
                                <input type="text" class="form-control" id="special3" name="special3" placeholder="Цена со скидкой" />
                            </div>

                            <div class="form-group">
                                <label for="special3">Лимит</label>
                                <input type="text" class="form-control" id="prime_cost" name="prime_cost" placeholder="Себестоимость товара" />
                            </div>

                            <div class="form-group">
                                <label for="count">Процент</label>
                                <input type="text" class="form-control" id="count" name="count" placeholder="Количество товара" />
                            </div>

                            <div class="form-group">
                                <label for="count">Процент</label>
                                <input type="text" class="form-control" id="count" name="count" placeholder="Количество товара" />
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">


                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>



            </div>
        </form>
    </section>
@stop