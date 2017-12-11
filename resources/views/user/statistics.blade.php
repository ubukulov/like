@extends('user/layout/user')
@section('content')
    @if(isset($result) AND count($result) > 0)
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
        $scrypt = '<script type="text/javascript">';
        $scrypt .= 'google.charts.load("current", {packages:["corechart"]});';
        $scrypt .= 'google.charts.setOnLoadCallback(drawChart);';
        $scrypt .= 'function drawChart() {';
        $scrypt .=      "var data = google.visualization.arrayToDataTable([['X', 'Количество продаж'],";
            $cnt = count($result);
            $t = 0;
            for($i=0; $i<count($result); $i++){
                $t = $i + 1;
                if($t == $cnt){
                    $scrypt .= "['".$result[$i]->mnt."', ".$result[$i]->cnt."]";
                }else{
                    $scrypt .= "['".$result[$i]->mnt."', ".$result[$i]->cnt."],";
                }

            }
        $scrypt .= ']);';

        $scrypt .= 'var options = {';
            $scrypt .= "legend: 'none',colors: ['#15A0C8'],pointSize: 15,pointShape: { type: 'circle', rotation: 180 }};";
            $scrypt .= "var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));";
            $scrypt .= "chart.draw(data, options);}</script>";
        echo $scrypt;
    ?>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    @endif
@stop