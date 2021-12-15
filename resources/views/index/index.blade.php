@extends('layouts.master')
@section('title','Axiell data analysis dashboard')

@section('content')

  <div class="container">
    <h1 class="display-5 text-center my-3">Axiell Data Analysis for the last 7 days</h1>
    <div class="row">

      <div class="col-md-6">
        <h2 class="lead text-center">Display moves</h2>
        @include('includes.movesTable', ['data' => $display])
        <a class="btn btn-info my-2" href="{{ route('moves') }}">Learn more</a>
      </div>

      <div class="col-md-6">
        <h2 class="lead text-center">Storage moves</h2>
        @include('includes.movesTable',['data' => $storage])
        <a class="btn btn-info my-2" href="{{ route('moves.storage') }}">Learn more</a>
      </div>

      <div class="col-md-6">
        <h2 class="lead text-center">Created records</h2>
        @include('includes.recordsTable',['data' => $created])
        <a class="btn btn-info my-2" href="{{ route('created') }}">Learn more</a>
      </div>

      <div class="col-md-6">
        <h2 class="lead text-center">Updated records</h2>
        @include('includes.recordsTable',['data' => $updated])
        <a class="btn btn-info my-2" href="{{ route('updated') }}">Learn more</a>
      </div>
    </div>
  </div>
@endsection
