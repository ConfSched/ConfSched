<h3>Author</h3>

<p>Congratulations on having your paper accepted to {{ Config::get('site.conference_name') }}! As an author, we value your input in the scheduling process. Please find below your tasks:</p>

<h4>Tasks to do:</h4>

<p><a href="{{ action('AuthorSourcingController@getAuthorSourcing') }}" class="btn btn-lg btn-primary btn-block">Author Sourcing</a></p>

<h4>Completed Tasks:</h4>

<p>You have not yet completed a task.</p>
