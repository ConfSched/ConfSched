<h3>Admin</h3>

<p>As an admin, you are tasked with controlling the phases of the scheduling process. These phases span preplanning, committee sourcing, author sourcing, and scheduling. Find your tasks below:</p>

<h4>Tasks to do:</h4>

<p><a href="{{ action('ConferenceController@getEditDetails') }}" class="btn btn-lg btn-primary btn-block">Edit Conference Details</a></p>
@if($preplanning->in_progress)
  <p><a href="{{ Config::get('site.openconf_url') }}" class="btn btn-lg btn-primary btn-block">Preplanning phase (OpenConf)</a></p>
  <p><a href="{{ action('ConferenceController@finalizePreplanning') }}" class="btn btn-lg btn-primary btn-block">Finalize Preplanning</a></p>
@endif
@if($preplanning->completed && ! $committeesourcing->in_progress && ! $committeesourcing->completed)
  <p><a href="{{ action('ConferenceController@startCommitteeSourcing') }}" class="btn btn-lg btn-primary btn-block">Start Committee Sourcing</a></p>
@endif
@if($preplanning->completed && ! $authorsourcing->in_progress && ! $authorsourcing->completed)
  <p><a href="{{ action('ConferenceController@startAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block">Start Author Sourcing</a></p>
@endif
@if($committeesourcing->in_progress)
  <p><a href="{{ action('ConferenceController@finalizeCommitteeSourcing') }}" class="btn btn-lg btn-primary btn-block">Finalize Committee Sourcing</a></p>
@endif
@if($authorsourcing->in_progress)
  <p><a href="{{ action('ConferenceController@finalizeAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block">Finalize Author Sourcing</a></p>
@endif
@if($authorsourcing->completed && $committeesourcing->completed && ! $scheduling->in_progress && ! $scheduling->completed)
  <p><a href="{{ action('ConferenceController@startSchedule') }}" class="btn btn-lg btn-primary btn-block">Start Scheduling</a></p>
@endif
@if($scheduling->in_progress)
  <p><a href="{{ action('ConferenceController@showSchedulePage') }}" class="btn btn-lg btn-primary btn-block">Schedule</a></p>
@endif

<h4>Upcoming Tasks:</h4>
@if(! $preplanning->in_progress && ! $preplanning->completed)
  <p><a href="{{ Config::get('site.openconf_url') }}" class="btn btn-lg btn-primary btn-block" disabled>Preplanning phase (OpenConf)</a></p>
  <p><a href="#" class="btn btn-lg btn-primary btn-block" disabled>Finalize Preplanning</a></p>
@endif
@if(! $committeesourcing->in_progress && ! $committeesourcing->completed)
  <p><a href="{{ action('CommitteeSourcingController@getCommitteeSourcing') }}" class="btn btn-lg btn-primary btn-block" disabled>Committee Sourcing</a></p>
@endif
@if(! $authorsourcing->in_progress && ! $authorsourcing->completed)
  <p><a href="{{ action('AuthorSourcingController@getAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block" disabled>Author Sourcing</a></p>
@endif
@if(! $scheduling->in_progress && ! $scheduling->completed)
  <p><a href="{{ action('ConferenceController@showSchedulePage') }}" class="btn btn-lg btn-primary btn-block" disabled>Schedule</a></p>
@endif
@if($scheduling->in_progress || $scheduling->completed)
  <p>No upcoming tasks</p>
@endif

<h4>Completed Tasks:</h4>

<p><i class="fa fa-check-square-o"></i> Installation</p>
@if($preplanning->completed)
  <p><i class="fa fa-check-square-o"></i> Preplanning</p>
@endif
@if($committeesourcing->completed)
  <p><i class="fa fa-check-square-o"></i> Committee Sourcing</p>
@endif
@if($authorsourcing->completed)
  <p><i class="fa fa-check-square-o"></i> Author Sourcing</p>
@endif
@if($scheduling->completed)
  <p><i class="fa fa-check-square-o"></i> Scheduling</p>
@endif

