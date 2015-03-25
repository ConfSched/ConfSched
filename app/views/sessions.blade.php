@extends('template')

@section('title')
	ConfSched | Sessions
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<h1>Sessions</h1>
	<hr>

	<div class="row">
		<div class="col-lg-12">

                <p><a href="{{ URL::previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>

		    {{ HTML::linkAction('ConferenceController@showAddSessionsPage', 'Add Session', [], ['class' => 'btn btn-primary btn-lg pull-right']) }}</p>

			{{-- @foreach($sessions as $session)
				<div class="col-lg-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">{{ Date::parse($session->start)->format('n/j D') }}</h3>
							<h5>{{ Date::parse($session->start)->format('g:i A') }} - {{ Date::parse($session->end)->format('g:i A')}}</h5>
						</div>
						<div class="panel-body">
							<p>{{ HTML::linkAction('ConferenceController@showEditSessionPage', 'Manage', ['id' => $session->id], ['class' => 'btn btn-default']) }}
							{{ HTML::linkAction('ConferenceController@removeSession', 'Remove', ['id' => $session->id], ['class' => 'btn btn-danger']) }}</p>
		                	<!-- <p><a href="#" class="btn btn-default">Manage</a>
		                	<a href="#" class="btn btn-danger">Remove</a></p> -->
		                	<p><strong>Number of papers:</strong> {{ $session->num_papers }}</p>
		                	<p><strong>Room:</strong> {{ $session->room->room }}</p>
		                    <!-- <div class="list-group">
		            			<div class="list-group-item">Blah</div>
		                    </div> -->
		                </div>
		            </div>
				</div>
			@endforeach --}}
			<div class="row">
			@foreach($dates as $date)
				<?php $sessions = Sessions::where(DB::Raw('CAST(start AS DATE)'), $date->date)->orderBy('start')->get(); ?>
				{{-- DBug::DBug(DB::getQueryLog()) --}}
				{{-- DBug::DBug($sessions->toArray()) --}}
                        @if (count($dates) == 3)
				  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        @elseif(count($dates) < 3)
                          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        @else
                          <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        @endif
				<h3>{{ Date::parse($date->date)->format('n/j D') }}</h3>
				@foreach($sessions as $session)
					<!-- <div class="col-lg-3"> -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<!-- <h3 class="panel-title">{{ Date::parse($session->start)->format('n/j D') }}</h3> -->
								<h5>{{ Date::parse($session->start)->format('g:i A') }} - {{ Date::parse($session->end)->format('g:i A')}}</h5>
							</div>
							<div class="panel-body">
								<p>{{ HTML::linkAction('ConferenceController@showEditSessionPage', 'Manage', ['id' => $session->id], ['class' => 'btn btn-default']) }}
								{{ HTML::linkAction('ConferenceController@removeSession', 'Remove', ['id' => $session->id], ['class' => 'btn btn-danger']) }}</p>
			                	<!-- <p><a href="#" class="btn btn-default">Manage</a>
			                	<a href="#" class="btn btn-danger">Remove</a></p> -->
			                	<p><strong>Number of papers:</strong> {{ $session->num_papers }}</p>
			                	<p><strong>Room:</strong> {{ $session->room->room }}</p>
			                    <!-- <div class="list-group">
			            			<div class="list-group-item">Blah</div>
			                    </div> -->
			                </div>
			            </div>
					<!-- </div> -->
				@endforeach
				</div>
			@endforeach
			</div>
		</div>
	</div>
@endsection
