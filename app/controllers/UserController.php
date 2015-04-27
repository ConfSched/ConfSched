<?php

class UserController extends \BaseController {

	/**
	 * Show user register form
	 * @return Response
	 */
	public function register() {

		$author = null;
		$member = null;

		if (Input::has('authorid')) {
			$author = Authors::findOrFail(Input::get('authorid'));
		}

		if (Input::has('committeeid')) {
			$member = Reviewer::findOrFail(Input::get('committeeid'));
		}

		if (is_null($author) && is_null($member)) {
			$first_name = '';
			$last_name = '';
			$email = '';
		}
		else {
			$first_name = (is_null($author) ? $member->name_first : $author->first_name);
			$last_name = (is_null($author) ? $member->name_last : $author->last_name);
			$email = (is_null($author) ? $member->email : $author->email);
		}

		return View::make('register', compact('author', 'member', 'first_name', 'last_name', 'email'));
	}

	/**
	 * Processes registration
	 * @return Response
	 */
	public function processRegister() {
		//DBug::DBug(Input::all(), true);

		$validator = Validator::make(Input::all(), ['username' => 'required|unique:users', 'password' => 'required', 'password_confirm' => 'required|same:password', 'email' => 'required|unique:users', 'first_name' => 'required', 'last_name' => 'required']);

		if ($validator->fails()) {
			return Redirect::action('UserController@register', ['committeeid' => Input::get('committeeid', ''), 'authorid' => Input::get('authorid', '')])->withInput()->withErrors($validator);
		}

		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->author = Input::has('authorid');
		$user->author_id = Input::get('authorid', null);
		$user->committee = Input::has('committeeid');
		$user->committee_id = Input::get('committeeid', null);
		$user->save();

		Auth::login($user);

		return Redirect::to('/');
	}

}
