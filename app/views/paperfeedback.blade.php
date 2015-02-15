@extends('template')

@section('title')
	ConfSched | Committee Sourcing
@endsection

@section('navigation')
	@include('navigation')
@endsection

@section('content')

	<script>
		$(function() {
			$('#paper_filter').on('change', function() {
                $(this).parents('form:first').submit();
			});
		});
	</script>

	<h1>Paper Feedback</h1>
	<hr>

	<p><b>Your Paper:</b> {{$paper2->title}}</p>

	<p><b>Paper Title:</b> {{$paper1->title}}<br><b>Paper Abstract:</b> {{$paper1->abstract}}</p>

	<br>

	<div class="errors">
		@foreach($errors->all('<li>:message</li>') as $error)
			{{ $error }}
		@endforeach
	</div>

	<form class="form" method="POST" action="{{action('ConferenceController@authorFeedback', array('paper1' => $paper1->paperid, 'paper2' => $paper2->paperid)) }}">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Is this paper relevant to your paper?</label>
					<div class="radio">
						<label>
							<input type="radio" name="relevant" id="relevant1" value="1">
							Yes
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="relevant" id="relevant1" value="2">
							No
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="relevant" id="relevant1" value="3">
							No opinion
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Would you be interested in attending the session with this paper?</label>
					<div class="radio">
						<label>
							<input type="radio" name="interest" id="relevant1" value="1">
							Yes
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="interest" id="relevant1" value="2">
							No
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="interest" id="relevant1" value="3">
							No opinion
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<input type="submit" class="btn btn-lg btn-block btn-primary" value="Provide Feedback">
				</div>
			</div>
		</div>
	</form>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
		</div>
	</div>
@endsection