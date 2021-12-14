@extends('layouts.master')

@section('title', 'Select a query')
@section('content')
<h1 class="display-4 text-center mt-3">Please select a timespan</h1>
<a href="{{ route('moves',['week'])}}" class="btn btn-info btn-large" role="button">Last 7 days</a>
<a href="{{ route('moves',['month'])}}" class="btn btn-info btn-large" role="button">Last month</a>
@endsection
