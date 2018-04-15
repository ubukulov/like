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
                        <div id="donutchart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </section>
        </div>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php if(isset($result[0])) :?>
                ["<?php echo $result[0]->store_name; ?>",     <?php echo $result[0]->cnt; ?>],
                <?php endif; ?>

                <?php if(isset($result[1])) :?>
                ["<?php echo $result[1]->store_name; ?>",     <?php echo $result[1]->cnt; ?>],
                <?php endif; ?>

                <?php if(isset($result[2])) :?>
                ["<?php echo $result[2]->store_name; ?>",     <?php echo $result[2]->cnt; ?>],
                <?php endif; ?>

                <?php if(isset($result[3])) :?>
                ["<?php echo $result[3]->store_name; ?>",     <?php echo $result[3]->cnt; ?>],
                <?php endif; ?>

                <?php if(isset($result[4])) :?>
                ["<?php echo $result[4]->store_name; ?>",     <?php echo $result[4]->cnt; ?>]
                <?php endif; ?>
            ]);

            var options = {
                title: 'ТОП 5 магазинов по продажам',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
@stop