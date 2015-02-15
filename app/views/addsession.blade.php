@extends('template')

@section('title')
	ConfSched | Sessions
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<script>
		$(function() {
			$('.datepicker').datepicker();
		});
	</script>

	<h1>Add Session</h1>
	<hr>

	<div class="row">
		<div class="col-lg-12">

			@if($errors->has())
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			@endif
		
			{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('date', 'Date: ') }}
							{{ Form::text('date', Input::old('date', ''), array('class' => 'form-control datepicker')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							{{ Form::label('start', 'Start: ') }}
							{{ Form::text('start', Input::old('start', ''), array('class' => 'form-control', 'placeholder' => 'HH:MM AM(PM)'))}}
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							{{ Form::label('end', 'End: ') }}
							{{ Form::text('end', Input::old('end', ''), array('class' => 'form-control', 'placeholder' => 'HH:MM AM(PM)'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('room', 'Room:') }}
							{{ Form::select('room', ['' => 'Please Select a Room'] + $rooms->lists('room', 'id'), '', ['class' => 'form-control']) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('num_papers', 'Number of Papers:') }}
							{{ Form::text('num_papers', '', ['class' => 'form-control']) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::submit('Add Session', array('class' => 'btn btn-lg btn-primary btn-block')) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection