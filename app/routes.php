<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('register', 'UserController@register');
Route::post('register', 'UserController@processRegister');
Route::get('sendEmailsAuthors', 'ConferenceController@alertUsersToCreateAccounts');

/**
 * Authentication
 */

# Login
Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');

# Logout
Route::get('logout', 'LoginController@getLogout');

# Signup
Route::get('signup', 'LoginController@showSignUpForm');
Route::post('signup', 'LoginController@signup');

/**
 * Committee Sourcing
 */

Route::get('committeesourcing', 'ConferenceController@showCommitteeSourcingPage');
Route::get('committeesourcing/addcategory/{id}', 'ConferenceController@showAddCategoryForm');
Route::post('committeesourcing/addcategory/{id}', 'ConferenceController@addCategory');
Route::get('committeesourcing/papers/{id}', 'ConferenceController@showAddToCategoryForm');
Route::post('committeesourcing/papers/{id}', 'ConferenceController@addToCategory');
Route::get('committeesourcing/removeCategory/{id}', 'ConferenceController@removeCategory');
Route::get('committeesourcing/removecategorypapermap/{paperid}/{categoryid}', 'ConferenceController@removeCategoryPaperMap');

/**
 * Author Sourcing
 */
Route::get('authorsourcing', 'ConferenceController@showAuthorSourcingPage');
Route::get('authorsourcing/feedback', 'ConferenceController@showProvideFeedbackPage');
Route::post('authorsourcing/feedback/{paper1}/{paper2}', 'ConferenceController@authorFeedback');
Route::get('authorsourcing/dismiss/{paper1}/{paper2}', 'ConferenceController@dismiss');
Route::get('authorsourcing/papers', 'ConferenceController@getAuthorSourcingPapers');
Route::get('author/{id}/papers', 'ConferenceController@getAuthorPapers');
Route::get('authorsourcing/papers/{id?}', 'ConferenceController@getAuthorSourcingPapers');

Route::get('authorfeedback/{paper1}/{paper2}/{userid}', 'ConferenceController@getAuthorFeedback');
Route::put('authorfeedback/{id}', 'ConferenceController@updateAuthorFeedback');
Route::post('authorfeedback', 'ConferenceController@storeAuthorFeedback');

/**
 * Schedule
 */


Route::get('populateauthors', 'ConferenceController@populateAuthorsTable');
Route::get('populatepapersauthors', 'ConferenceController@populatePapersAuthorsTable');

Route::get('process', 'ConferenceController@showProcessPage');
Route::get('acceptedpapers', 'ConferenceController@completeOpenConf');


Route::get('schedule', 'ConferenceController@showSchedulePage');
Route::get('constraints', 'ConferenceController@showConstraintsPage');
Route::get('addauthorsessionconstraint', 'ConferenceController@showAddAuthorSessionConstraintPage');
Route::post('addauthorsessionconstraint', 'ConferenceController@addAuthorSessionConstraint');
Route::get('addauthormapconstraint', 'ConferenceController@showAddAuthorMapPage');
Route::post('addauthormapconstraint', 'ConferenceController@addAuthorMap');
Route::get('addrooms', 'ConferenceController@showAddRoomsPage');
Route::get('sessions', 'ConferenceController@showSessionsPage');
Route::get('addsessions', 'ConferenceController@showAddSessionsPage');
Route::post('addsessions', 'ConferenceController@addSesssion');
Route::get('editsession/{id}', 'ConferenceController@showEditSessionPage');
Route::put('editsession/{id}', 'ConferenceController@editSession');
Route::get('deleteSession/{id}', 'ConferenceController@removeSession');
Route::get('swap/{paper1}/{paper2}', 'ConferenceController@swap');
Route::post('addrooms', 'ConferenceController@addRooms');



Route::get('clearschedule', function() {
	Sessions::truncate();
	SessionPaper::truncate();
});
Route::get('populateschedule', function() {

	Sessions::truncate();
	SessionPaper::truncate();

	$papers = Paper::where('accepted', 'Accept')->get();
	var_dump($papers);
	$rooms = Room::all();

	$session = new Sessions;
	$session->start = Date::parse('January 10, 2015 10:30 AM');
	$session->end = Date::parse('January 10, 2015 12:00 PM');
	$session->room_id = $rooms->random()->id;
	$session->save();

	$session2 = new Sessions;
	$session2->start = Date::parse('January 10, 2015 1:30 AM');
	$session2->end = Date::parse('January 10, 2015 3:00 PM');
	$session2->room_id = $rooms->random()->id;
	$session2->save();

	$session3 = new Sessions;
	$session3->start = Date::parse('January 11, 2015 10:00 AM');
	$session3->end = Date::parse('January 11, 2015 12:00 PM');
	$session3->room_id = $rooms->random()->id;
	$session3->save();

	$session4 = new Sessions;
	$session4->start = Date::parse('January 11, 2015 2:00 AM');
	$session4->end = Date::parse('January 11, 2015 3:30 PM');
	$session4->room_id = $rooms->random()->id;
	$session4->save();

	$sessions = Sessions::all();

	foreach($papers as $paper) {
		$sessionpaper = new SessionPaper;
		$sessionpaper->session_id = $sessions->random()->id;
		$sessionpaper->paper_id = $paper->paperid;
		$sessionpaper->save();
	}

	// $sessionpaper = new SessionPaper;
	// $sessionpaper->session_id = $session->id;
	// $sessionpaper->paper_id = $papers->random()->paperid;
	// $sessionpaper->save();

	return Redirect::action('ConferenceController@showSchedulePage');

});
