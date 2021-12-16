@extends('layouts.master')
@section('title','Axiell data analysis dashboard')

@section('content')

  <div class="container">
    <h1 class="display-5 text-center my-3">
      Axiell Data Analysis for the last 7 days
    </h1>
    <div class="row">

      <div class="col-md-6">
        <div id="displaychart" style="width:100%;min-height:400px;"></div>
        <h2 class="lead text-center">Display moves</h2>
        @include('includes.movesTable', ['data' => $display])
        <a class="btn btn-info my-2" href="{{ route('moves') }}">View analysis and more</a>
      </div>

      <div class="col-md-6">
        <div id="storagechart" style="width:100%;min-height:400px;" ></div>
        <h2 class="lead text-center">Storage moves</h2>
        @include('includes.movesTable',['data' => $storage])
        <a class="btn btn-info my-2" href="{{ route('moves.storage') }}">View analysis and more</a>
      </div>

      <div class="col-md-6">
        <div id="createdchart" style="width:100%;min-height:400px;"></div>
        <h2 class="lead text-center">Created records</h2>
        @include('includes.recordsTable',['data' => $created])
        <a class="btn btn-info my-2" href="{{ route('created') }}">View analysis and more</a>
      </div>

      <div class="col-md-6">
        <div id="updatedchart" style="width:100%;min-height:400px;"></div>
        <h2 class="lead text-center">Updated records</h2>
        @include('includes.recordsTable',['data' => $updated])
        <a class="btn btn-info my-2" href="{{ route('updated') }}">View analysis and more</a>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @php
  function parseObject($array){
      $departments = [];
      foreach ($array->adlibJSON->recordList->record as $object) {
          if (isset($object->administration_name[0])) {
              $department = $object->administration_name[0]->value[1];
              if (!isset($departments[$department])) {
                  $departments[$department] = 0;
              }
              $departments[$department]++;
          }
      }
      return $departments;
    }
  $displayData = parseObject($display);
  $storageData = parseObject($storage);
  $createdData = parseObject($created);

  $updatedData = parseObject($updated);

  @endphp
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(lineChart);
  function lineChart() {
    var display = new google.visualization.DataTable();
    display.addColumn('string', 'Department');
    display.addColumn('number', 'Records');
    display.addRows([
      @foreach($displayData as $key => $value)
      ['{{ $key }}', {{ $value }}],
      @endforeach
    ]);
    var storage = new google.visualization.DataTable();
    storage.addColumn('string', 'Department');
    storage.addColumn('number', 'Records');
    storage.addRows([
      @foreach($storageData as $key => $value)
      ['{{ $key }}', {{ $value }}],
      @endforeach
    ]);

    var created = new google.visualization.DataTable();
    created.addColumn('string', 'Department');
    created.addColumn('number', 'Records');
    created.addRows([
      @foreach($createdData as $key => $value)
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
    var updated = new google.visualization.DataTable();
    updated.addColumn('string', 'Department');
    updated.addColumn('number', 'Records');
    updated.addRows([
      @foreach($updatedData as $key => $value)
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
    var chartDisplay = new google.visualization.PieChart(document.getElementById('displaychart'));
    var chartStorage = new google.visualization.PieChart(document.getElementById('storagechart'));
    var chartCreated = new google.visualization.PieChart(document.getElementById('createdchart'));
    var chartUpdated = new google.visualization.PieChart(document.getElementById('updatedchart'));

    chartDisplay.draw(display, options);
    chartStorage.draw(storage, options);
    chartCreated.draw(created, options);
    chartUpdated.draw(updated, options);

    $(window).resize(function(){
      lineChart();
    });
  }
  </script>

@endsection
