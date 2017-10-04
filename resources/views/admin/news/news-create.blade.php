@extends('admin/layout/default')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Форма добавление новости
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/news/store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" class="form-control" id="title" required="required" name="title" placeholder="Введите название">
                        </div>

                        <div class="form-group">
                            <label>Опубликовать</label>
                            <select name="publish" id="publish" class="form-control">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Ключевые слова</label>
                            <input type="text" class="form-control" id="meta_keywords" name="keywords" placeholder="meta_keywords" />
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="col-md-4">
                            <div class="form-group">
                                <div id="image1">
                                    <img src="{{ asset('img/no_thumb.png') }}" height="100" name="image1">
                                </div>
                                <br>
                                <button id="upload1" class="blue">Выбрать картинку</button>
                            </div>
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

                        <div class="form-group">
                            <label for="desc">Короткое описание</label>
                            <textarea id="desc" class="form-control wysiwyg" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Полные описание</label>
                            <textarea id="description" class="form-control wysiwyg" name="text"></textarea>
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