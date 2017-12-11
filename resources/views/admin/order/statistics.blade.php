@extends('admin/layout/default')
@section('content')
    <section class="content-header">
        <h1>
            Статистика
            <small>по заказом</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Продажа</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div id="piechart_3d" style="width: 900px; height: 500px;">
                            @if(isset($result[0]->cnt))
                            <input type="hidden" id="sl_cnt1"  value="{{ $result[0]->cnt }}">
                            <input type="hidden" id="sl_name1" value="{{ $result[0]->store_name }}">
                            @endif

                            @if(isset($result[1]->cnt))
                            <input type="hidden" id="sl_cnt2" value="{{ $result[1]->cnt }}">
                            <input type="hidden" id="sl_name2" value="{{ $result[1]->store_name }}">
                            @endif

                            @if(isset($result[2]->cnt))
                            <input type="hidden" id="sl_cnt3" value="{{ $result[2]->cnt }}">
                            <input type="hidden" id="sl_name3" value="{{ $result[2]->store_name }}">
                            @endif

                            @if(isset($result[3]->cnt))
                            <input type="hidden" id="sl_cnt4" value="{{ $result[3]->cnt }}">
                            <input type="hidden" id="sl_name4" value="{{ $result[3]->store_name }}">
                            @endif

                            @if(isset($result[4]->cnt))
                            <input type="hidden" id="sl_cnt5" value="{{ $result[4]->cnt }}">
                            <input type="hidden" id="sl_name5" value="{{ $result[4]->store_name }}">
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </section>
        </div>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- /.content -->
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var sl_cnt1 = $("#sl_cnt1").val();
            var sl_name1 = $("#sl_name1").val();

            var sl_cnt2 = $("#sl_cnt2").val();
            var sl_name2 = $("#sl_name2").val();

            var sl_cnt3 = $("#sl_cnt3").val();
            var sl_name3 = $("#sl_name3").val();

            var sl_cnt4 = $("#sl_cnt4").val();
            var sl_name4 = $("#sl_name4").val();

            var sl_cnt5 = $("#sl_cnt5").val();
            var sl_name5 = $("#sl_name5").val();

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                [sl_name1, sl_cnt1],
                [sl_name2, sl_cnt2],
                [sl_name3, sl_cnt3],
                [sl_name4, sl_cnt4],
                [sl_name5, sl_cnt5]
            ]);

            var options = {
                title: 'ТОП-5 магазинов',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
@stop