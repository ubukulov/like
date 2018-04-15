@extends('layouts.news')
@section('content')
    <div class="row_tsk news">
        <h3>{{ $news->title }}</h3>
        <hr>
        <p>
            {!! $news->content !!}
        </p>
    </div>
@stop