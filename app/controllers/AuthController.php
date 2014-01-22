<?php

class AuthController extends BaseController {

	public function getIndex() {
		return View::make('auth.auth')
		->with('title','auth');
	}

	public function getLogged () {
		if (! Sentry::check()) {
			return Redirect::to('/auth');
		}
		else {
			return View::make('auth.logged')
			->with('title','logged in');
		}
	}
	public function getLogout () {
		Sentry::logout();
		return Redirect::to('/auth');
		
	}
}
