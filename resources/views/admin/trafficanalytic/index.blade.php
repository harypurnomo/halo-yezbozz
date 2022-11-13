@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            
            <h3 class="kt-subheader__title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
    </div>
</div>
<!-- end:: Content Head -->					

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<div class="row">

	    <div class="col-xl-12">
	        <div id="curve_chart" style="width: 100%; height: 500px;"></div>
	    </div>

	</div>

  <div class="kt-space-20"></div>

  <div class="row">

      <div class="col-xl-12">
          <div id="columnchart_values" style="width: 100%; height: 500px;"></div>
      </div>

  </div>
	
	<div class="kt-space-20"></div>

  <div class="row">

      <div class="col-xl-12">
          <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
      </div>

  </div>

</div>

{{-- {{ dd($fetchTotalVisitorsAndPageViews) }} --}}

    
@endsection

@section('js')
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Type', 'Sessions'],
          ["{{ $fetchUserTypes[0]['type'] }}", {{ $fetchUserTypes[0]['sessions'] }}],
          ["{{ $fetchUserTypes[1]['type'] }}", {{ $fetchUserTypes[1]['sessions'] }}]

        ]);

        var options = {
          title: 'Fetch the most user type for the current day and the last 30 days',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Visitors', 'Page Views'],
          @foreach ($fetchTotalVisitorsAndPageViews as $element)
          	['{{ $element['date'] }}',  {{ $element['visitors'] }},      {{ $element['pageViews'] }}],
          @endforeach
        ]);

        var options = {
          title: 'Fetch the most visitors and pageviews for the current day and the last 7 days',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["URL", "Page Views", { role: "style" } ],
        @foreach ($fetchTopReferrers as $element)
          	['{{ $element['url'] }}',  {{ $element['pageViews'] }},      "#b87333"],
        @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Fetch the most top referrers for the current day and the last 7 days",
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

@endsection