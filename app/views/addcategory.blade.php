@extends('template')

@section('title')
	ConfSched | Committee Sourcing
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<h3>Add Category</h3>
	<hr>

	<div class="row">
		<div class="col-lg-12">
			{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::label('name', 'Name: ') }}
							{{ Form::text('name', Input::old('name', ''), array('class' => 'form-control'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							{{ Form::submit('Add Category', array('class' => 'btn btn-lg btn-primary btn-block')) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
