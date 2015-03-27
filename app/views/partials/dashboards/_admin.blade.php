<h3>Admin</h3>

<p>As an admin, you are tasked with controlling the phases of the scheduling process. These phases span preplanning, committee sourcing, author sourcing, and scheduling. Find your tasks below:</p>

<h4>Tasks to do:</h4>

<p><a href="#" class="btn btn-lg btn-primary btn-block">Edit Conference Details</a></p>
<p><a href="{{ Config::get('site.openconf_url') }}" class="btn btn-lg btn-primary btn-block">Preplanning phase (OpenConf)</a></p>
<p><a href="#" class="btn btn-lg btn-primary btn-block">Finalize Preplanning</a></p>
<p><a href="{{ action('CommitteeSourcingController@getCommitteeSourcing') }}" class="btn btn-lg btn-primary btn-block" disabled>Committee Sourcing</a></p>
<p><a href="{{ action('AuthorSourcingController@getAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block" disabled>Author Sourcing</a></p>
<p><a href="{{ action('ConferenceController@showSchedulePage') }}" class="btn btn-lg btn-primary btn-block" disabled>Schedule</a></p>

<h4>Completed Tasks:</h4>

<p><i class="fa fa-check-square-o"></i> Installation</p>

