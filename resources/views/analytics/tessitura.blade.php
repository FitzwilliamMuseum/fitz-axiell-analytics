@extends('layouts.master')
@section('content')
<h1 class="display-4 text-center my-3">Website Use: Tessitura TNEW platform</h1>
@include('includes.analytics')

<div class="my-2 text-center">
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.tessitura',['week']) }}">Last 7 days</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.tessitura',['month']) }}">Last month</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.tessitura',['quarter']) }}">Quarter</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.tessitura',['6month']) }}">Six months</a>
  <a class="btn btn-dark mr-1 mb-2" href="{{ route('analytics.tessitura',['year']) }}">Last year</a>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@include('includes.userCountTessitura')
@include('includes.arpu')
@include('includes.userTypeChart', $types)
@include('includes.visitorsChart', $visitors)
@include('includes.purchasesChart', $purchases->rows)
@include('includes.revenueChart', $purchases->rows)
@endsection
