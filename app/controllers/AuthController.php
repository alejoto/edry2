<?php

class AuthController extends BaseController {


	public function getIndex() {
	    return View::make('auth.auth')
	      ->with('title','auth');
	     }


	

}
