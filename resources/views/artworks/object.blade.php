@extends('layouts.master')
@section('title', 'Object details for ' . $data->adlibJSON->recordList->record[0]->object_number[0])

  @section('content')
  <div class="container">
    @foreach($data->adlibJSON->recordList->record as $object)
      <h1 class="display-4 text-center my-2">
        @if(!@empty($object->title))
          @foreach($object->title as $title)
            @if(!$loop->last)
              {{ $title }} |
            @else
              {{ $title }}
            @endif
          @endforeach
        @else
          {{ ucfirst($object->object_name[0]) }}
        @endif
      </h1>
      <div class="row">
      @if(!@empty( $ciim->multimedia))
        <div class="container-fluid bg-white">
          <div class=" mx-auto mb-3">
            <div>
              <img width="100%" class="img-fluid mx-auto d-block main-image" src="{{ env('MEDIA_URL') }}{{ $ciim->multimedia[0]->processed->large->location }}" loading="lazy" alt="An image for this record">
            </div>
          </div>
        </div>
      @endif
  </div>
</div>
@endSection

@section('metadata')
  <div class="container-fluid bg-grey pt-3">
    <div class="container">
        <div class="col-md-12">
        @if(!empty($object->{"current_location.type"}))
        <div class="alert alert-info text-center text-white bg-purple">
          <h2 class="display-3 text-center">{{ ucfirst($object->{"current_location.type"}[0]) }}</h2>
          @if($object->{"current_location.type"}[0] != 'storage')
            @if(!@empty($object->{"current_location.description"}))
            <strong>
              You can find this on display at the following location: {{ $object->{"current_location.description"}[0] }}
            </strong>
            @endif
          @endif
        </div>
      @else
        <div class="alert alert-danger text-center text-black">
          <h2 class="display-3 text-center">No Location Type Recorded!</h2>
        </div>
      @endif
      <h3 class="lead collection">What is the accession number?</h3>
      <p>{{ $object->object_number[0] }}</p>
      <a class="btn btn-success my-2" href="https://collection.beta.fitz.ms/id/object/{{ $object->priref[0] }}">View this online</a>

        @if(!@empty($object->object_name))
          <h3 class="lead collection">What type of object is this?</h3>
          <p> {{ ucfirst($object->object_name[0]) }}</p>
        @endif
        @if(!empty($object->{"current_location.date"}))
        <h3 class="lead collection">When was the location updated?</h2>
        <p>{{ Carbon\Carbon::parse($object->{"current_location.date"}[0])->format('D d F Y H:m a') ?? ''}}</p>
        @endif
        <h3 class="lead collection">Which Department is responsible for this?</h2>
        <p>{{ $object->administration_name[0]->value[1] ?? ''}}</p>

        @if(!@empty($object->description))
          @foreach ($object->description as $description)
            <p>{{ ucfirst($description) ?? ''}}</p>
          @endforeach
        @endif

        @if(!@empty($object->{"production.notes"}))
          @foreach ($object->{"production.notes"} as $description)
            <p>{!! ucfirst($description) ?? '' !!}</p>
          @endforeach
        @endif

        @if(!@empty($object->{"production.notes"}))
        <p>{{ $object->credit_line[0] ?? ''}}
        @endif
        @if(!@empty($object->creator))
          @php
          if($object->creator[0] != ''){
            $creators = array_combine($object->creator, $object->{'creator.role'} );
          } else {
            $creators = [];
          }
          @endphp
          @if(!@empty($creators))
            <h3 class="lead collection">Who made this?</h2>
            <ul>
              @foreach ($creators as $key => $value)
                <li class="square">{{ $key }}: {{ $value }}</li>
              @endforeach
            </ul>
          @endempty
        @endif
          @if(!@empty ($object->exhibition))
            <h3 class="lead collection">Has this been exhibited anywhere?</h2>
            <ul>
              @foreach ($object->exhibition as $exhibition)
                <li class="square">{{ $exhibition }}</li>
              @endforeach
            </ul>
          @endempty

          <h3 class="lead collection">When was this record updated</h2>
          <p>{{ Carbon\Carbon::parse($object->{"@attributes"}->modification )->format('D d F Y H:m a')}}</p>

        </div>

      @endforeach
    </div>
  </div>

  @endSection
