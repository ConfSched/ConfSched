<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{

	$details = DB::table('details')->first();
	if ($details === null) {
		Config::set('site.installation', true);
	}
	else {
		$name = $details->name;
		$image = $details->image;
		$about = $details->about;

		Config::set('site.conference_name', $name); // this is here for some legacy code that used config files
		Config::set('site.conference_about', $about); // this is here for some legacy code that used config files
	}

	//$current_step = DB::table('progress')->where('completed', '<>', true)->orderBy('id')->first();


	//Config::set('site.current_step', $current_step);
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('auth.author', function() {
	if (Auth::guest() || ! Auth::user()->author) {
		return Redirect::guest('login');
	}
});

Route::filter('auth.admin', function() {
	if (Auth::guest() || ! Auth::user()->admin) {
		return Redirect::guest('login');
	}
});

Route::filter('auth.committee', function() {
	if (Auth::guest() || ! Auth::user()->committee) {
		return Redirect::guest('login');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
