<h3>Author</h3>

<p>Congratulations on having your paper accepted to {{ Config::get('site.conference_name') }}! As an author, we value your input in the scheduling process. Please find below your tasks:</p>

<h4>Tasks to do:</h4>

@if ($authorsourcing->in_progress)
  <p><a href="{{ action('AuthorSourcingController@getAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block">Author Sourcing</a></p>
@else
  <p>You have no tasks to complete.</p>
@endif

<h4>Completed Tasks:</h4>

@if($authorsourcing->completed)
  <p><i class="fa fa-check-square-o"></i> Author Sourcing</p>
@else
  <p>You have not yet completed a task.</p>
@endif
