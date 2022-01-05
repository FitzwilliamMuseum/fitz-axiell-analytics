@extends('layouts.master')
@section('content')
<h1 class="display-4 text-center my-3">Website Use: Main site</h1>
@include('includes.analytics')
<div class="my-2 text-center">
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.website',['week']) }}">Last 7 days</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.website',['month']) }}">Last month</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.website',['quarter']) }}">Quarter</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.website',['6month']) }}">Six months</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.website',['year']) }}">Last year</a>
</div>
@include('includes.userCount')
@include('includes.topPages')
@include('includes.devicesChart')
@include('includes.geochart')
@endsection
