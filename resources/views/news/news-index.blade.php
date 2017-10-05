@extends('layouts.news')
@section('content')
    <div class="row_tsk news">
        @foreach($news as $item)
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-sm-2" style="width: 240px;">
                <a href="{{ url('/news/'.$item->id) }}"><img src="{{ asset('uploads/news/'.$item->image) }}" alt=""></a>
            </div>
            <div class="col-sm-10" style="width: 900px;">
                <span class="news_date">{{ russian_date($item->dt) }}</span><br><br>
                <a href="{{ url('/news/'.$item->id) }}">{{ $item->title }}</a><br>
                <p>{{ $item->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
@stop