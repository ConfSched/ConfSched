@extends('template')

@section('title')
	ConfSched | Constraints
@endsection

@section('content')

	<h1>Add Author Session Constraint</h1>
	<hr>

      <p><a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>

      <p>Adding an author session constraint allows you to mark an author as unavailable for a session. We will not schedule the author the given session.</p>

	<div class="row">
		<div class="col-lg-12">
			{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('author', 'Author: ') }}
							{{ Form::select('author', $authors->lists('full_name', 'id'), Input::old('author', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('session', 'Session: ') }}
							{{ Form::select('session', $sessions->lists('display_value', 'id'), Input::old('session', ''), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::submit('Add Constraint', array('class' => 'btn btn-lg btn-primary btn-block')) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
