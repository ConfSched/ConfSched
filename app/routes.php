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

Route::get('/', 'ConferenceController@getIndex');

/**
 * Install
 */
Route::post('processintall', 'ConferenceController@processInstall');

/**
 * Registration
 */

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

Route::group(['prefix' => 'committeesourcing'], function() {
	Route::get('/', 'CommitteeSourcingController@getCommitteeSourcing');
	Route::get('category/create', 'CommitteeSourcingController@getCreateCategory');
	Route::post('category/{id}', 'CommitteeSourcingController@postCategory');
	Route::get('paper/{id}', 'CommitteeSourcingController@getPaper');
	Route::post('paper/{id}', 'CommitteeSourcingController@postPaper');
	Route::delete('category/{id}', 'CommitteeSourcingController@deleteCategory');
	Route::delete('category/{category_id}/paper/{paper_id}', 'CommitteeSourcingController@deleteCategoryPaperMap');
});

/**
 * Author Sourcing
 */
Route::group(['prefix' => 'authorsourcing'], function() {
	Route::get('/', 'AuthorSourcingController@getAuthorSourcing');
	Route::get('feedback', 'AuthorSourcingController@getProvideFeedback');
	Route::post('feedback/{paper1}/{paper2}', 'AuthorSourcingController@postProvideFeedback');
	Route::get('dismiss/{paper1}/{paper2}', 'AuthorSourcingController@getDismiss');
	Route::get('papers/{id?}', 'AuthorSourcingController@getPapers');
	Route::get('feedback/{paper1}/{paper2}/{userid}', 'AuthorSourcingController@getAuthorFeedback');
	Route::put('feedback/{id}', 'AuthorSourcingController@putAuthorFeedback');
	Route::post('feedback', 'AuthorSourcingController@postAuthorFeedback');
});

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

Route::get('generateSchedule', 'ConferenceController@generateSchedule');

/**
 * Dashboard
 */

Route::get('details/edit', 'ConferenceController@getEditDetails');
Route::post('details/edit', 'ConferenceController@postEditDetails');
Route::get('details', 'ConferenceController@getDetails');
Route::get('finalizepreplanning', 'ConferenceController@finalizePreplanning');
Route::get('startcommitteesourcing', 'ConferenceController@startCommitteeSourcing');
Route::get('startauthorsourcing', 'ConferenceController@startAuthorSourcing');
Route::get('finishcommitteesourcing', 'ConferenceController@finalizeCommitteeSourcing');
Route::get('finishauthorsourcing', 'ConferenceController@finalizeAuthorSourcing');
Route::get('startschedule', 'ConferenceController@startSchedule');
Route::get('startpreplanning', 'ConferenceController@startPreplanning');


