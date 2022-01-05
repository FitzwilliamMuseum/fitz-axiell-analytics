@if(!@empty($types))
<div class="row">
  <div class="col-md-6">
    <div id="chart" style="width: 100%; min-height: 500px"></div>
  </div>
</div>
<script type="text/javascript">
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(lineChart);
function lineChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Type');
  data.addColumn('number', 'Volume');
  data.addRows([
    @foreach($types as $item)
    ['{{ $item['type'] }}', {{ $item['sessions'] }}],
    @endforeach
  ]);
  var options = {
    title: 'Tessitura User Types',
    pieHole: 0.4,
    curveType: 'function',
    legend: {
      position: 'right'
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById('chart'));
  chart.draw(data, options);
  $(window).resize(function(){
    lineChart();
  });
}

</script>
@endempty
