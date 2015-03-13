@extends('template')

@section('title')
	ConfSched | Schedule
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<script>
		$(function() {
			$('.btn-swap').on('click', function() {
				var paper1 = $('#paper1').val();
				if (paper1 == '') {
					$("#paper1").val($(this).attr('data-paper-id'));
				}
				else {
					window.location.href = "swap/" + paper1 + "/" + $(this).attr('data-paper-id');
				}
			});
		});
	</script>

	<h1>Schedule</h1>
	<hr>

	@if(count($sessions) < 1 || true)
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showAddRoomsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Rooms</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showSessionsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Sessions</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showConstraintsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Constraints</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				@if(count($rooms) < 1)
					<a href="#" class="btn btn-lg btn-primary btn-block" style="margin-bottom: 10px;" disabled>Generate</a>
				@else
					<a href="populateschedule" class="btn btn-lg btn-primary btn-block" style="margin-bottom: 10px;">Generate</a>
				@endif
			</div>
		</div>
	@else
		<input type="hidden" id="paper1">
		<div class="row">
			<?php $i = 0; ?>
			@foreach($sessions as $session)
				@if($i % 2 == 0)
					<div class="clearfix visible-xs-block"></div>
				@elseif($i % 3 == 0)
					<div class="clearfix visible-sm-block visible-md-block"></div>
				@elseif ($i % 4 == 0)
					<div class="clearfix visible-lg-block"></div>
				@endif
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
					<h3>{{ Date::parse($session->start)->format('n/j') }}</h3>
					<strong>{{Date::parse($session->start)->format('g:i A')}} - {{Date::parse($session->end)->format('g:i A')}}</strong>
					<hr style="margin-bottom: 0; margin-top: 0;">
					@foreach($session->papers as $paper)
						<h5>{{$paper->title}}</h5>
						<button class="btn btn-default btn-xs btn-swap" data-paper-id="{{$paper->paperid}}">Swap</button>
					@endforeach
				</div>
				<?php $i ++; ?>
				<!-- <div class="clearfix visible-xs-block"></div> -->
			@endforeach
		</div>
		<br>
	@endif
	<!-- content goes here -->

@endsection
