@extends('layouts.master')
@section('title', 'Created records')
@section('content')
<h1 class="display-4 text-center my-3">Created records</h1>
<div class="my-2">
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('created',['week']) }}">Last 7 days</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('created',['month']) }}">Last month</a>
  <a class="btn btn-info mb-2" href="{{ route('updated') }}">Or see what was updated?</a>

</div>

<p>
  Number of objects: {{ $adlibData->total() }}
</p>

<a class="btn btn-info mb-2" href="{{ route('created.export', [request()->segment(2)]) }}">Download data as csv</a>


@if($adlibData->onFirstPage())
@include('includes.recordsCharts')
@endif

@if(preg_match('/\d{4}\-\d{2}\-\d{2}/', $adlibData->items()['adlibJSON']->diagnostic->search, $matches))
<div class="alert alert-info text-center">
  Search starts from: {{ Carbon\Carbon::parse($matches[0])->format('l dS F Y')  }} <strong>Today's date is {{ Carbon\Carbon::today()->format('l dS F Y')   }}</strong>
</div>
@endif

@if(@isset($adlibData->items()['adlibJSON']->recordList))
<div class="alert alert-danger my-2 text-center">If an object was created within the last 6 hours, the collections explorer link will not work</div>
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
        <th>Created</th>
    	</tr>
    </thead>

    <tbody>
     @foreach ($adlibData->items()['adlibJSON']->recordList->record as $object)
       {{-- @dd($object) --}}
       <tr>
         <th scope="row">
           @isset($object->object_number)
           <a href="https://collection.beta.fitz.ms/id/object/{{ $object->priref['0'] }}">{{ $object->object_number['0'] }}</a>
          @else
            No number recorded
          @endisset
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
           {{ $object->{"current_location.description"}[0]  ?? ''}}
         <td>
           @isset($object->current_location)
             {{ $object->current_location[0] ?? ''}}
           @endisset
         </td>
         <td>
           {{ Carbon\Carbon::parse($object->{"@attributes"}->created)->format('d-m-Y h:m a')}}
         </td>
       </tr>
     @endforeach
   </tbody>
</table>
<div class="d-flex justify-content-center">
  <nav aria-label="Page navigation" >
    {{ $adlibData->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
  </nav>
</div>
@else
  <p>No data recorded for this period</p>
@endif
@endsection
