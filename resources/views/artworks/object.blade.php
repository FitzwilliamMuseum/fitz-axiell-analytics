@extends('layouts.master')
@section('title', 'Object details for ' . $data->adlibJSON->recordList->record[0]->object_number[0])
@section('content')
  <div class="container">
    @foreach($data->adlibJSON->recordList->record as $object)
      <h1 class="display-4 text-center my-2">{{ $object->object_number[0] }}: {{ ucfirst($object->object_name[0]) }} </h1>
      <div class="row">
      @if(!@empty( $ciim->multimedia))
      <div class="col-md-4">
          <img src="{{ env('MEDIA_URL') }}{{ $ciim->multimedia[0]->processed->large->location }}" class="img-fluid" />
      </div>
      <div class="col-md-8">
      @else
        <div class="col-md-12">
          @endif
        @if(!empty($object->{"current_location.type"}))
        <div class="alert alert-info text-center text-white bg-dark">
          <h2 class="display-2 text-center">{{ ucfirst($object->{"current_location.type"}[0]) }}</h2>
          @if($object->{"current_location.type"}[0] != 'storage')
            @if(!@empty($object->{"current_location.description"}))
            <strong>
              You can find this on display at the following location: {{ $object->{"current_location.description"}[0] }}
              {{-- {{ $object->current_location[0] }} --}}
            </strong>
          @endif
            {{-- {{ $object->{"location.description"}[0] ?? ''}}  {{ $object->{"location"}[0] ?? ''}} --}}
          @endif
        </div>
      @else
        <div class="alert alert-danger text-center text-black">
          <h2 class="display-2 text-center">No Location Type Recorded!</h2>
        </div>
      @endif
        <a class="btn btn-success my-2" href="https://collection.beta.fitz.ms/id/object/{{ $object->priref[0] }}">View this online</a>
        @if(!empty($object->{"current_location.date"}))
        <h2 class="lead">When was the location updated?</h2>
        <p>{{ $object->{"current_location.date"}[0] ?? ''}}</p>
        @endif
        <h2 class="lead">Which Department is responsible for this?</h2>
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
            <h2 class="lead">Who made this?</h2>
            <ul>
              @foreach ($creators as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
              @endforeach
            </ul>
          @endempty
        @endif
          @if(!@empty ($object->exhibition))
            <h2 class="lead">Has this been exhibited anywhere?</h2>
            <ul>
              @foreach ($object->exhibition as $exhibition)
                <li>{{ $exhibition }}</li>
              @endforeach
            </ul>
          @endempty

          <h2 class="lead">When was this record updated</h2>
          <p>{{ Carbon\Carbon::parse($object->{"@attributes"}->modification )->format('d-m-Y h:m a')}}</p>

        </div>
        {{-- @dump($data->adlibJSON->recordList->record[0]) --}}

      @endforeach
    </div>
    </div>
  @endSection
