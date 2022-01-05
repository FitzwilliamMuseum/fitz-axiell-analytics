@if(!@empty($purchases->rows))
<div class="row">
  <div class="col-md-12">
    <div id="purchases" style="width: 100%;"></div>
    <div>
      <table class="table table-bordered table-hover ">
          <thead class="thead-dark">
            <tr>
              <th>Product</th>
              <th>Transactions</th>
              <th>Revenue</th>
          	</tr>
          </thead>

          <tbody>
           @foreach ($purchases->rows as $item)
             <tr>
               <td >
                 {{ $item[0] }}
               </th>
               <td>
                 {{ $item[1] }}
               </td>
               <td>
                 £{{ number_format($item[2],2) }}
               </td>
             </tr>
           @endforeach
           <tr>
             <th scope="row">

             </th>
             <td>

             </td>
             <td>
               Income £{{ number_format(array_sum(array_column($purchases->rows,2)),2); }}
             </td>
           </tr>
         </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
google.charts.load('current', {
  'packages': ['corechart']
});
google.charts.setOnLoadCallback(areaChart);
function areaChart() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Product');
  data.addColumn('number', 'Transactions');
  data.addColumn('number', 'Revenue');
  data.addRows([
    @foreach($purchases->rows as $item)
    @if($item[2] > 100)
    ['{{ $item[0] }}', {{ $item[1] }}, {{ $item[2] }}],
    @endif
    @endforeach
  ]);
  var options = {
         title: 'Transactions performance: value > £100',
         hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
         vAxis: {minValue: 0}
       };
  var chart = new google.visualization.AreaChart(document.getElementById('purchases'));
  chart.draw(data, options);
  $(window).resize(function(){
    areaChart();
  });
}
</script>
@endempty
