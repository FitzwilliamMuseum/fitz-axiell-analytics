@php
$array = $chartData->adlibJSON->recordList->record;
$departments = [];
foreach ($array as $object) {
    if (isset($object->administration_name[0])) {
        $department = $object->administration_name[0]->value[1];
        if (!isset($departments[$department])) {
            $departments[$department] = 0;
        }
        $departments[$department]++;
    }
}
@endphp

@if(!@empty($departments))
<div id="linechart" style="width: 800px; height: 500px"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(lineChart);
function lineChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Department');
  data.addColumn('number', 'Moves');
  data.addRows([
    @foreach($departments as $key => $value)
    ['{{ $key }}', {{ $value }}],
    @endforeach
  ]);
  var options = {
    title: 'Department counts',
    pieHole: 0.4,
    curveType: 'function',
    legend: {
      position: 'right'
    }
  };
  var chart = new google.visualization.PieChart(document.getElementById('linechart'));
  chart.draw(data, options);
}
</script>
@endempty
