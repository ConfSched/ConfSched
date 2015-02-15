@extends('template')

@section('title')
	ConfSched | Home
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')
	<style>
		.main-content-wrapper {
			width: 50%;
		}
	</style>

	<h1>Login</h1>
	<hr>

	<div class="errors">
		@foreach($errors->all('<li>:message</li>') as $error)
			{{ $error }}
		@endforeach
	</div>

	<div class="pull-right" style="padding-bottom: 10px;">{{ link_to('/signup', "Don't have an account?") }}</div>

	@if(Session::has('error'))
		{{ Session::get('error') }}
	@endif

	{{ Form::open(array('class' => 'form', 'method' => 'POST')) }}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<div class="form-group">
					{{ Form::text('username', Input::old('username', ''), array('placeholder' => 'Username', 'class' => 'form-control'))}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<div class="form-group">
					{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control'))}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<div class="form-group">
					{{ Form::submit('Login', array('class' => 'btn btn-lg btn-block btn-primary'))}}
				</div>
			</div>
		</div>
	{{ Form::close() }}
@endsection