@extends('admin/layout/default')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Форма добавление новости
    </h1>
</section>
<section class="content">
    <form action="{{ url('admin/news/'.$news->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="title">Наименование</label>
                            <input type="text" class="form-control" id="title" value="{{ $news->title }}" required="required" name="title" placeholder="Введите название">
                        </div>

                        <div class="form-group">
                            <label>Опубликовать</label>
                            <select name="publish" id="publish" class="form-control">
                                <option @if($news->publish == '1') selected="selected" @endif value="1">Да</option>
                                <option @if($news->publish == '0') selected="selected" @endif value="0">Нет</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Ключевые слова</label>
                            <input type="text" class="form-control" value="{{ $news->keywords }}" id="meta_keywords" name="keywords" placeholder="meta_keywords" />
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
                                    @if(!empty($news->image))
                                        <img  src="{{ asset('uploads/news/'.$news->image) }}" height="100">
                                        <input type="hidden" name="photo1" value="{{ $news->image }}" />
                                    @else
                                        <img src="{{ asset('img/no_thumb.png') }}" height="100">
                                    @endif
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
                            <textarea id="desc" class="form-control wysiwyg" name="description">{{ $news->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Полные описание</label>
                            <textarea id="description" class="form-control wysiwyg" name="content">{!! $news->content !!}</textarea>
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