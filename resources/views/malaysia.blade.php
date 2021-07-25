@extends('layout.mainlayout')

@section('content')
    <?php
        $jsonFix = urldecode(csvToJson());
        $cases_malaysia = json_decode($jsonFix, true);
        
        $lol = array(
            array("Year", "Sales")
        );

        for($i=0; $i<(sizeof($cases_malaysia)); $i++){
            array_push($lol, array($cases_malaysia[$i]['date'], (int)$cases_malaysia[$i]['cases_new']));
        }
    ?>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      var lol = <?php echo json_encode($lol); ?>;

      function drawChart() {
        var data = google.visualization.arrayToDataTable(lol);

        var options = {
          title: 'New cases',
          hAxis: {
              ticks: [5000,10000,15000,20000]
            },
          vAxis: {
              ticks: [5000,10000,15000,20000]
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      window.onresize = drawChart;
    </script>

    <body>

    <div id="chart_div" style="width: 100%; height: 500px; margin-top: 20px"></div>
    <!--cases_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--cases_state-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--tests_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--clusters-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--deaths_malaysia-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--deaths_state-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--pkrc-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--hospital-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

    <!--icu-->
    <div style="display: grid">
        <div>Total<div>
        <div>Today<div>
    <div>

@endsection

    



