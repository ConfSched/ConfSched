@extends('template')

@section('title')
	ConfSched | Process
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')
	<style>
		.list-group { margin-bottom:0px; }
	</style>

	<h1>Conference Setup Process</h1>
	<hr>

	<table class="table table-bordered">
		<tr>
			<th>Step #</th>
			<th>Step</th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<td>1.</td>
			<td>OpenConf</td>
			<td><a href="/openconf" class="btn btn-block btn-primary">Work on this step</a></td>
			<td><a href="{{ action('ConferenceController@completeOpenConf') }}" class="btn btn-block btn-danger">Mark as complete</a></td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Committee Sourcing</td>
			<td><button class="btn btn-block btn-success" disabled>Start</button></td>
			<td><!-- <button class="btn btn-block" disabled>Done</button> --></td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Author Sourcing</td>
			<td><!-- <button class="btn btn-block">Goto</button> --></td>
			<td><!-- <button class="btn btn-block">Done</button> --></td>
		</tr>
		<tr>
			<td>4.</td>
			<td>Confer</td>
			<td><!-- <button class="btn btn-block">Goto</button> --></td>
			<td><!-- <button class="btn btn-block">Done</button> --></td>
		</tr>
		<tr>
			<td>5.</td>
			<td>Scheduling</td>
			<td><!-- <button class="btn btn-block">Goto</button> --></td>
			<td><!-- <button class="btn btn-block">Done</button> --></td>
		</tr>
	</table>
@endsection