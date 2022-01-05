@if(!@empty($devices))

<div class="row">
  <div class="col-md-12">
    <div id="devices" style="width: 100%; min-height: 500px"></div>
  </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(lineChart);
function lineChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Device');
  data.addColumn('number', 'Volume');
  data.addRows([
    @foreach($devices as $item)
    ['{{ $item['dimension'] }}', {{ $item['metric'] }}],
    @endforeach
  ]);
  var options = {
    title: 'Devices used',
    pieHole: 0.4,
    curveType: 'function',
    legend: {
      position: 'right'
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById('devices'));
  chart.draw(data, options);
  $(window).resize(function(){
    lineChart();
  });
}

</script>
@endempty
