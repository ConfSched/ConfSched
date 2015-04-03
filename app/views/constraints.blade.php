@extends('template')

@section('title')
	ConfSched | Constraints
@endsection

@section('content')

	<h1>Constraints</h1>
	<hr>

	<div class="row">
		<div class="col-lg-12">

                <p><a href="{{ action('ConferenceController@showSchedulePage') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a></p>

                  <p>Here you may add any additional constraints that your schedule may have.</p>

                  <ul>
                    <li>An author session constraint allows you to specify that an author is unavailable for a certain session. This will ensure that they will not be scheduled for that session when you generate a schedule. </li>
                    <li>In the preplanning stages, authors may use multiple email addresses when submitting papers. This poses a problem when it comes time for the author feedback phase. Authors will have an account for each email address they supplied in submitting their papers. However, you may map accounts to each other so that multiple accounts merge into a single account.</li>
                  </ul>

			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showAddAuthorSessionConstraintPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Add Author Session Constraint</a>
			</div>
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<a href="{{ action('ConferenceController@showAddAuthorMapPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Map Author Accounts</a>
			</div>
			<!-- <div class="col-xs-12 col-md-4 col-md-offset-4">
				<a href="{{ action('ConferenceController@showConstraintsPage') }}" class="btn btn-lg btn-default btn-block" style="margin-bottom: 10px;">Add </a>
			</div> -->

		</div>
	</div>
@endsection
