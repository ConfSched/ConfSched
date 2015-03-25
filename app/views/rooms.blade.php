@extends('template')

@section('title')
  ConfSched | Sessions
@endsection

@section('navigation')
  @include('navigation')
@endsection

@section('content')

  <h1>Rooms</h1>
  <hr>

  <div class="row">
    <div class="col-lg-12">

                <p><a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>

        {{ HTML::linkAction('ConferenceController@showAddRoomsPage', 'Add Rooms', [], ['class' => 'btn btn-primary btn-lg pull-right']) }}</p>


      <div class="row">

      </div>
    </div>
  </div>
@endsection
