@extends('layouts.master')
@section('title', 'Find an artwork')
@section('content')
  <h1 class="text-center my-3">Find an object: on display or in storage?</h1>
<div class="col-md-12 p-3 mx-auto mb-3 justify-content-center">
  <div class="row col-lg-12 justify-content-center align-items-center">
    @include('includes.flash')

    <div class="col-md-12">
      <p class="text-center">
        Search for an object and find out where it is - use the collections reference number.
      </p>
      <p class="text-center">
        What would you search for - use a number like this <strong>C.759-2016</strong> or <strong>M.4 & A-1972</strong>
      </p>
      <p class="text-center">
        Remember results you get will only be as good as our documentation. Data entered = Data retrieved. If a record is
        incomplete, you may get false results for the location. 
      </p>
    </div>
  {{ \Form::open(['url' => route('object.results'),'method' => 'GET']) }}
  <div class="row center-block">
    <div class="col-lg-12 center-block searchform">
      <div class="input-group mr-3">
        <input type="text" id="query" name="query" value="" class="form-control mr-2"
        placeholder="Search for an object" required value="{{ old('query') }}">
        <span class="input-group-btn">
          <button class="btn btn-dark" type="submit">Search...</button>
        </span>
      </div>
    </div>
  </div>
  @if(count($errors))
  <div class="form-group">
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif
  {!! Form::close() !!}
  </div>
</div>
@endsection
