@if(!@empty($visitors))
  {{-- @dd($visitors) --}}
<div class="row">
  <div class="col-md-6">
    <div id="visitors" style="width: 100%; min-height: 500px"></div>
  </div>
</div>
<script type="text/javascript">
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(lineChart);
function lineChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('date', 'Date');
  data.addColumn('number', 'Visitors');
  data.addColumn('number', 'Page views');
  data.addRows([
    @foreach($visitors as $item)
    [ new Date({{ Carbon\Carbon::parse($item['date'])->format('Y, m, d') }}),{{ $item['visitors'] }},{{ $item['pageViews'] }}],
    @endforeach
  ]);
  var options = {
    title: 'Tessitura Daily users',
    curveType: 'function',
    legend: {
      position: 'right'
    }
  };
  var chart = new google.visualization.LineChart(document.getElementById('visitors'));
  chart.draw(data, options);
  $(window).resize(function(){
    lineChart();
  });
}

</script>
@endempty
