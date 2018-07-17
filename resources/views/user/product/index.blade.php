@extends('user/layout/user')
@section('content')
    <h4>Мои товары</h4>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <th>ID</th><th>Наименование</th><th>Кол-во</th><th>Цена</th><th>Вознаграждение</th><th>Действие</th><th>Дата</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->count }}</td>
                        <td>{{ number_format((int) $product->special2,0,' ',' ') }} тг</td>
                        <td>{{ number_format((int) $product->com_agent,0,' ',' ') }} тг</td>
                        <td><a href="{{ url('user/product/edit/' . $product->id) }}">Редактировать</a></td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
@stop