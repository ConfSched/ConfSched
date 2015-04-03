<h3>Committee</h3>

<p>As a commitee member to {{ Config::get('site.conference_name') }} your input is important to us. Your input will help us generate better schedules with more logical sessions. Please see your tasks below:</p>

<h4>Tasks to do:</h4>

@if ($committeesourcing->in_progress)
  <p><a href="{{ action('CommitteeSourcingController@getCommitteeSourcing') }}" class="btn btn-lg btn-primary btn-block">Committee Sourcing</a></p>
@else
  <p>You have no tasks to complete.</p>
@endif

<h4>Completed Tasks:</h4>

@if ($committeesourcing->completed)
  <p><i class="fa fa-check-square-o"></i> Committee Sourcing</p>
@else
  <p>You have not yet completed a task.</p>
@endif
