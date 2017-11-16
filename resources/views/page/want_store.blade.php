@extends('layouts.news')
@section('content')
    <div class="row_tsk news">
        <h4>{{ $page->name_ru }}</h4>
        <br>
        {!! $page->text !!}
    </div>
@stop