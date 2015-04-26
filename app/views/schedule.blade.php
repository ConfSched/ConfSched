@extends('template')

@section('title')
	ConfSched | Schedule
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

	@if(count($sessions) < 1)
          <div class="row">
            <div class="col-xs-12">
              <p><a href="{{ action('ConferenceController@getIndex') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>
              <p>Welcome to the schedule page. Here you can add rooms for your schedule, set up the sessions for your schedule, add any constraints for your schedule, and generate your schedule.</p>

              <ol>
                <li>Add your rooms</li>
                <li>Add your sessions</li>
                <li>Add any other constraints</li>
                <li>Generate Schedule</li>
              </ol>
            </div>
          </div>

		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showAddRoomsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Manage Rooms</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showSessionsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Manage Sessions</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showConstraintsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Manage Constraints</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				@if(count($rooms) < 1)
					<a href="#" class="btn btn-lg btn-primary btn-block" style="margin-bottom: 10px;" disabled>Generate Schedule</a>
				@else
					<a href="{{ action('ConferenceController@generateSchedule') }}" class="btn btn-lg btn-primary btn-block" style="margin-bottom: 10px;">Generate</a>
				@endif
			</div>
		</div>
	@else
            {{ DBug::DBug($sessions->toArray()); }}
            <div class="row">

            @foreach($sessions->sessions as $session)
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                  <h3>{{ Date::parse($session->start)->format('n/j') }}</h3>
                  <strong>{{Date::parse($session->start)->format('g:i A')}} - {{Date::parse($session->end)->format('g:i A')}}</strong>
                </div>
                @foreach($session->author as $author)
                  <h5>{{$author->print}}</h5>
                  {{-- <button class="btn btn-default btn-xs btn-swap" data-paper-id="{{$paper->paperid}}">Swap</button> --}}
                @endforeach
            @endforeach
	@endif
	<!-- content goes here -->

@endsection
