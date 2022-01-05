@if(!@empty($purchases->rows))

<div class="row">
  <div class="col-md-12">
    <div id="purchases" style="width: 100%; min-height: 500px"></div>
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
    @foreach($purchases->rows as $item)
    ['{{ $item[0] }}', {{ $item[1] }}],
    @endforeach
  ]);
  var options = {
    title: 'Tessitura Product Purchases',
    pieHole: 0.4,
    curveType: 'function',
    legend: {
      position: 'right'
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById('purchases'));
  chart.draw(data, options);
  $(window).resize(function(){
    lineChart();
  });
}

</script>
@endempty
