@extends('template')

@section('title')
	ConfSched | Constraints
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<h1>Constraints</h1>
	<hr>

	<div class="row">
		<div class="col-lg-12">
			
			<div class="col-xs-12 col-md-4 col-md-offset-4">
				<a href="{{ action('ConferenceController@showAddAuthorSessionConstraintPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Add Author Session Constraint</a>
			</div>
			<div class="col-xs-12 col-md-4 col-md-offset-4">
				<a href="{{ action('ConferenceController@showAddAuthorMapPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Map Author Accounts</a>
			</div>
			<!-- <div class="col-xs-12 col-md-4 col-md-offset-4">
				<a href="{{ action('ConferenceController@showConstraintsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Add </a>
			</div> -->

		</div>
	</div>
@endsection