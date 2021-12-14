@extends('layouts.master')
@section('title', 'Location Moves')
@section('content')
<h1 class="display-4 text-center my-3">Location Moves: Objects on display</h1>
<div class="my-2">
  <a class="btn btn-dark" href="{{ route('moves',['week']) }}">Last 7 days</a>
  <a class="btn btn-dark" href="{{ route('moves',['month']) }}">Last month</a>
  <a class="btn btn-dark" href="{{ route('moves',['quarter']) }}">Quarter</a>
  <a class="btn btn-dark" href="{{ route('moves',['6month']) }}">Six months</a>
  <a class="btn btn-dark" href="{{ route('moves',['year']) }}">Last year</a>
  <a class="btn btn-info" href="{{ route('moves.storage') }}">Or see what's moved in storage</a>
</div>

<p>
  Number of objects: {{$adlibData->adlibJSON->diagnostic->hits}}
</p>

@include('includes.movesCharts')

@if(preg_match('/\d{4}\-\d{2}\-\d{2}/', $adlibData->adlibJSON->diagnostic->search, $matches))
<div class="alert alert-info">
  Search starts from: {{ Carbon\Carbon::parse($matches[0])->format('l dS F Y')  }} <strong>Today's date is {{ Carbon\Carbon::today()->format('l dS F Y')   }}</strong>
</div>
@endif

<table class="table table-bordered table-striped table-responsive">
    <thead class="thead-dark">
      <tr>
        <th>Object Number</th>
        <th>Department</th>
        <th>Title</th>
        <th>Object Name</th>
        <th>Maker or Creator</th>
        <th>Current Location</th>
        <th>Exact Location</th>
    	</tr>
    </thead>

    <tbody>
     @foreach ($adlibData->adlibJSON->recordList->record as $object)
       <tr>
         <th scope="row">
           <a href="https://collection.beta.fitz.ms/id/object/{{ $object->priref['0'] }}">{{ $object->object_number['0'] }}</a>
         </th>
         <td>
           {{ $object->administration_name[0]->value[1] ??  '' }}
         </td>
         <td>
           {{ $object->title[0] ?? 'No title has been created' }}
         </td>
         <td>
           {{ ucfirst($object->object_name[0] ?? '') }}
         </td>
         <td>
           {{ $object->creator[0] ?? '' }}
         </td>

         <td>
           {{ $object->{"current_location.description"}[0] }}
         <td>
           {{ $object->current_location[0] }}
         </td>

       </tr>
     @endforeach
   </tbody>
</table>
@endsection
