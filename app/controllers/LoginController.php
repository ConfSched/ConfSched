<?php

class LoginController extends \BaseController {

	/**
	 * Displays the login form to the user
	 * GET /login
	 *
	 * @return Response
	 */
	public function getLogin() {
		return View::make('login');
	}

	/**
	 * Displays the sign up form to the user
	 * GET /signup
	 *
	 * @return Response
	 */
	public function showSignUpForm() {
		return View::make('signup');
	}

	/**
	 * Process the user's login request
	 * POST /login
	 *
	 * @return Response
	 */
	public function postLogin() {
		if (Auth::attempt(array('username' => Input::get('username', ''), 'password' => Input::get('password', ''))))
		{
    		return Redirect::intended('/');
		}

		return Redirect::action('LoginController@getLogin')->with('error', 'Invalid username/password combination');
	}

	/**
	 * Process the user's logout request
	 * GET /logout
	 *
	 * @return Response
	 */
	public function getLogout() {
		Auth::logout();

		return Redirect::to('/');
	}

	/**
	 * Process the user's signup request
	 * POST /signup
	 *
	 * @return Response
	 */
	public function signup() {
		$rules = array(
			'username' => 'required|min:4|unique:users',
			'password' => 'required|min:6',
			'email' => 'required|email|unique:users',
			'first_name' => 'required',
			'last_name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user = new User;
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->email = Input::get('email');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->save();

		Auth::login($user);

		return Redirect::to('/');
	}

}
