@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Список работы
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Испольнитель</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Ссылка</th>
                                <th>Статус</th>
                                <th>Дата публикации</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($works as $work) :?>
                            <tr>
                                <td>
                                    {{ $work->id }}
                                </td>
                                <td class="avatar">
                                    <img @if(!empty($work->avatar)) src="{{ asset('uploads/users/small/'.$work->avatar) }}" @else src="{{ asset('img/blank_avatar_220.png') }}" @endif alt="" height="40" width="60" />
                                    {{ $work->firstname." ".$work->lastname }}
                                </td>
                                <td>
                                    {{ $work->title }}
                                </td>
                                <td>
                                    {!! $work->text !!}
                                </td>
                                <td>
                                    <a href="{{ $work->link_to_work }}" rel="nofollow" target="_blank">Перейти</a>
                                </td>
                                <td>
                                    @if($work->status == 0)
                                        Ожидает
                                    @elseif($work->status == 1)
                                        Одобрено
                                    @else
                                        Отменен
                                    @endif
                                </td>
                                <td>
                                    {{ $work->created }}
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{ $works->links() }}
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@stop