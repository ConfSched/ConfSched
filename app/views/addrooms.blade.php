@extends('template')

@section('title')
  ConfSched | Add Rooms
@endsection

@section('content')

  <h1>Add Rooms</h1>
  <hr>


  <div class="row">
    <div class="col-xs-12">
      <p><a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>

      <p>To add rooms, please specify a CSV file with the following information room name (this will be the display name), capacity, and whether or not this room can have special equipment.</p>

      <p>Here is an example a correclty formatted CSV file:</p>
      <pre>Room,Capacity,Equipment
Trexler 363,30,true
Trexler 263,25,false
Olin 120,20,false
Trexler 372,30,false
IT Closet,4,false</pre>

    <div class="alert alert-warning" role="alert"><strong>Warning</strong>, this will overwrite all existing rooms with the data of your new CSV file. If you want to add a room, be sure all your existing rooms are still in the CSV file.</div>

      {{ Form::open(array('class' => 'form', 'method' => 'POST', 'files' => true)) }}
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              {{ Form::label('file', 'CSV File: ') }}
              {{ Form::file('file', array('class' => 'form-control')) }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              {{ Form::submit('Add Rooms', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            </div>
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
  <!-- content goes here -->

@endsection
