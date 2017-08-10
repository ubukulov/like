@extends('admin/layout/default')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Форма редактирование  тип задании
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/task/type_update/'.$type->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        <div class="form-group">
                            <label for="name_ru">Наименование</label>
                            <input type="text" class="form-control" id="name_ru" required="required" name="name_ru" value="{{ $type->name_ru }}" placeholder="Введите название">
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="image1">
                                    @if(!empty($type->image))
                                    <img src="{{ asset('uploads/tasks/types/small/'.$type->image) }}" height="100" name="image1">
                                    @else
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                                    @endif
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать обложку</button>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Сохранить</button>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </form>
</section>
@stop