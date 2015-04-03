@extends('template')

@section('title')
  ConfSched | Edit Conference Details
@endsection

@section('content')
  <script src="{{ asset('assets/javascripts/ckeditor/ckeditor.js') }}"></script>
  {{-- <script src="../adapters/jquery.js"></script> --}}

  <script>
    $(function() {
      //CKEDITOR.inline( 'conference_about' );
    });
  </script>

  <h1>Edit Conference Details</h1>
  <hr>

  {{ Form::open() }}
    <p><a href="/" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>
    <div class="form-group">
      <label for="conference_name">Conference Name</label>
      <input type="text" name="conference_name" value="{{ $name }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="conference_image">Conference Image</label>
      <input type="file" name="conference_image" class="form-control">
    </div>
    <div class="form-group">
      <label for="conference_about">Conference About</label>
      <textarea name="conference_about" class="ckeditor" class="form-control">{{ $about }}</textarea>
    </div>
    <div class="form-group">
      <input type="submit" value="Save" class="btn btn-lg btn-primary">
    </div>
  {{ Form::close() }}
@endsection
