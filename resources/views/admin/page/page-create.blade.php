@extends('admin/layout/default')
@section('content')
<section class="content-header">
    <h1>
        Форма добавление страницы
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/page/store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name_kz">Наименование на казахском</label>
                            <input type="text" class="form-control" id="name_kz" name="name_kz" placeholder="Введите название на казахском">
                        </div>

                        <div class="form-group">
                            <label for="name_ru">Наименование на русском</label>
                            <input type="text" class="form-control" id="name_ru" required="required" name="name_ru" placeholder="Введите название на русском">
                        </div>

                        <div class="form-group">
                            <label for="name_en">Наименование на английском</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Введите название на английском">
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <textarea name="keywords" class="form-control" id="keywords" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="desc">Короткое описание</label>
                            <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="features">Полное описание</label>
                            <textarea name="features" class="form-control" id="features" cols="30" rows="10"></textarea>
                        </div>

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
    </div>
</section>
@stop