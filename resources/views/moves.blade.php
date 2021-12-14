@extends('layouts.master')
@section('title', 'Location Moves')
@section('content')
<h1 class="display-4 text-center">Location Moves: Objects on display</h1>
<div class="my-2">
<a class="btn btn-dark" href="{{ route('moves',['week']) }}">Last 7 days</a>
<a class="btn btn-dark" href="{{ route('moves',['month']) }}">Last month</a>
<a class="btn btn-dark" href="{{ route('moves',['quarter']) }}">Quarter</a>
<a class="btn btn-dark" href="{{ route('moves',['6month']) }}">Six months</a>
<a class="btn btn-dark" href="{{ route('moves',['year']) }}">Last year</a>
</div>
<p>
  Number of objects: {{$adlibData->adlibJSON->diagnostic->hits}}
</p>
<p>Search: {{str_replace("And current_location->location.type Equals 'display'", "", str_replace("current_location.date Greater", "Since", $adlibData->adlibJSON->diagnostic->search))}}</p>
<table class="table table-bordered table-striped table-responsive">
    <thead class="thead-dark">
      <tr>
        <th>Object Number</th>
        <th>Department</th>
        <th>Title</th>
        <th>Object Name</th>
        <th>Object Category</th>
        <th>Creator</th>
        <th>Creator Role</th>
        <th>Current Location</th>
        <th>Current Location Detail</th>
    	</tr>
    </thead>

	 <tbody>
    @foreach ($adlibData->adlibJSON->recordList->record as $objdat)
    	<tr>
        <td>
          <a href="https://collection.beta.fitz.ms/id/object/{{ $objdat->priref['0'] }}">{{ $objdat->object_number['0'] }}</a>
        </td>
        <td>
          {{ $objdat->administration_name[0]->value[1] ??  '' }}
        </td>
        <td>
          {{ $objdat->title[0] ?? 'No title has been created' }}
        </td>
        <td>
          {{ $objdat->object_name[0] ?? '' }}
        </td>
        <td>
          {{ $objdat->object_category[0] ?? '' }}
        </td>
        <td>
          {{ $objdat->creator[0] ?? '' }}
        </td>
        <td>
          @if(property_exists($objdat,"creator.role"))
          {{ ucfirst($objdat->{"creator.role"}[0]) ?? '' }}
          @endif
        </td>
        <td>
          {{ $objdat->{"current_location.description"}[0] }}
        <td>
          {{ $objdat->current_location[0] }}
        </td>

    	</tr>
    @endforeach
	</tbody>
</table>


@endsection
