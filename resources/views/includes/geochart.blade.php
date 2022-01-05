<script type="text/javascript">
google.charts.load('current', {
  'packages':['geochart'],
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable([
    ['Country', 'Users'],
    @foreach($country as $territory)
    ['{{$territory['dimension']}}', {{$territory['metric']}}],
    @endforeach
  ]);

  var options = {
    title: 'Top 100 countries using resource',

    legend: {
      position: 'right'
    }
  };

  var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

  chart.draw(data, options);
}
</script>

<div id="regions_div" style="width: 100%; height: 500px;"></div>
