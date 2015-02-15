@extends('template')

@section('title')
	ConfSched | Add Rooms
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<h1>Add Rooms</h1>
	<hr>


	<div class="row">
		<div class="col-xs-12">
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