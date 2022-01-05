@extends('layouts.master')
@section('content')
<h1 class="display-4 text-center my-3">Website Use: Collection site</h1>
@include('includes.analytics')
<div class="my-2 text-center">
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.collection',['week']) }}">Last 7 days</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.collection',['month']) }}">Last month</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.collection',['quarter']) }}">Quarter</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.collection',['6month']) }}">Six months</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.collection',['year']) }}">Last year</a>
</div>
@include('includes.userCount')
@include('includes.topPages')
@include('includes.devicesChart')
@include('includes.geochart')
@endsection
