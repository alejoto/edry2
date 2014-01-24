<?php

class Ajaxauth extends BaseController {
	

	public function postPermissionnew () {
		$pss=$_POST['pss'];
		$pssdesc=$_POST['pssdesc'];
		$psscount=Permission::name($pss)->count();
		
		if ($psscount==0) {
			$permission=new Permission;
			$permission->permissionname=$pss;
			$permission->permissiondescription=$pssdesc;
			$permission->save();
			return 1;
		}
		else {return 2;}
	}

	public function postPermissionedit () {
		$id=$_POST['id'];
		$name=$_POST['name'];
		$descp=$_POST['descp'];
		$u=array(
			'permissionname'		=>$name,
			'permissiondescription'	=>$descp
			);
		if (Permission::find($id)->update($u)) {
			return 1;
		}
		else {return 2;}
	}

	public function postDeletepermission () {
		$id=$_POST['id'];
		Permission::find($id)->delete();
	}

	public function postGroupnew () {
		$name=$_POST['ngroup'];
		$p=$_POST['grouppermission'];
		$p=str_replace(' ','', $p);
		$p=explode(',', $p);
		$permission;
		foreach ($p as $p) {
			$permission[$p]=1;
		}

		try
		{
		    // Create the group
		    $group = Sentry::createGroup(array(
		        'name'        => $name,
		        'permissions' => $permission,
		    ));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    return 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    return 'Group already exists';
		}
	}

	public function postGroupedit () {
		try
		{
			$id=$_POST['parent_id'];
			$editedname=$_POST['name'];
			$pms=$_POST['pms']; 
			$pms=str_replace(' ','', $pms); 
			$pms=explode(',', $pms);
			$permission;
			foreach ($pms as $p) {
				$permission[$p]=1;
			}
			//
			//
			$nopms=$_POST['nopms'];
			$nopms=str_replace(' ','', $nopms); 
			$nopms=explode(',', $nopms);
			foreach ($nopms as $np) {
				$permission[$np]=0;
			}
		    // Find the group using the group id
		    $group = Sentry::findGroupById($id);

		    //Resetting group permissions in order to remove deprecated ones.
		    foreach ($group->getPermissions() as $key => $value) {
		    	$reset[$key]=0;
		    }
		    $group->permissions=$reset;$group->save();

		    // Update the group details
		    $group->name = $editedname;
		    $group->permissions = $permission;

		    // Update the group
		    if ($group->save())
		    {
		        // Group information was updated
		    }
		    else
		    {
		        // Group information was not updated
		    }
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
		
	}

	public function postGroupdelete () {
		$id=$_POST['id'];

		try
		{
		    // Find the group using the group id
		    $group = Sentry::findGroupById($id);

		    // Delete the group
		    $group->delete();
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return 'Group was not found.';
		}
	}

	public function postSubscribe () {
		$email=$_POST['semail'];
		$password=$_POST['spwd'];
		
		try {
			// Create the user
		    $user = Sentry::createUser(array(
		        'email'     => $email,
		        'password'  => $password,
		        'activated' => true,
		    ));

		    // Find the group using the group id
		    $adminGroup = Sentry::findGroupById(1);//Change as default the lowest user profile

		    // Assign the group to the user
		    $user->addGroup($adminGroup);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    return 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    return 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return  'Group was not found.';
		}
	}

	public function postLogin () {
		$emaillogin=$_POST['emaillogin'];
		$pwslogin=$_POST['pwslogin'];
		//return 'test 1';
		try
		{
		    // Set login credentials
		    $credentials = array(
		        'email'    => $emaillogin,
		        'password' => $pwslogin,
		    );

		    // Try to authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}
		
	}

	public function postChangepassword () {
		$id=$_POST['id'];
		$pwd=$_POST['pwd'];
		try {
			$user = Sentry::findUserById($id);
			$user->password=$pwd;
			if ($user->save()) {
				return 1;
			}
			else {return 2;}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			echo 'User was not found.';
		}
	}

	public function postUpdateusername () {
		$id=$_POST['id'];
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		try {
			$user = Sentry::findUserById($id);
			$user->first_name=$first_name;
			$user->last_name=$last_name;
			if ($user->save()) {
				return 1;
			}
			else {return 2;}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			echo 'User was not found.';
		}
	}

	public function postResetpwd () {
		$email=$_POST['email'];
		$user = Sentry::findUserByLogin($email);
		try
		{
		    //
		    $resetCode = $user->getResetPasswordCode();// Get the password reset code
		    $link='<a href="'.URL::to('auth/resetpwd').'?key='.$resetCode.
			'">Use this link to reset password</a>';
			//Message data
			$mssgdata=array('link'   =>   $link);
			//Email data
			$maildata=array(
			    'recipient'		=>    $email
			   , 'r_name'		=>    'HMD user'
			   , 'sender'		=>    'support@healmydisease.com'
			   , 's_name'		=>    'The HMD team'
			   , 'subject'		=>    'Reset password request'
			);
			Mail::send(   'emails.resetpwd',   $mssgdata,  function($message) use ($maildata) {
				$message->to($maildata['recipient'],$maildata['r_name'])
						->from($maildata['sender'],$maildata['s_name'])
						->subject($maildata['subject']);
			});
			return 1;
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return 2;
		}
	}

	public function postChangepwd () {
		$email=Input::get('confirm_email');
		$pwd=Input::get('resetpwd_new_password');
		$key=Input::get('get_reset_key');
		
		try{
			$user = Sentry::findUserByLogin($email);
			if ($user->checkResetPasswordCode($key)) {
				if ($user->attemptResetPassword($key,$pwd)) {
					$credentials = array(
			        'email'    => $email,
			        'password' => $pwd,
			    	);
			    	$user = Sentry::authenticate($credentials, false);
				 	return Redirect::to('auth/logged');//Change to the login page
				}
				else {
					//password reset failed
				}
					
			}
			else{
				return Redirect::to('auth/resetpwd?key='.$key.'&mssg=wrong');
			}
		}
		catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
			return Redirect::to('auth/resetpwd?key='.$key.'&mssg=noexist');
		}
		
	}

	public function postEditusergroup () {
		$id=$_POST['id'];
		$g=$_POST['group'];

		try
		{
			$user = Sentry::findUserById($id);// Find the user using the user id
			$adminGroup = Sentry::findGroupById($g);// Find the group using the group id
			//finding current group
			$current=$user->groups()->first()->id;
			$removegroup = Sentry::findGroupById($current);
			$user->removeGroup($removegroup);
			//PENDING TO FIND CURRENT USER GROUP AND ITS ID IN ORDER TO REMOVE
			//AS NO USER CAN HAVE TWO OR MORE GROUPS. 
			if ($user->addGroup($adminGroup))// Assign the group to the user
		    {
		        return 1;
		    }
		    else
		    {
		        // Group was not assigned
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) { echo 'User was not found.'; }
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) { echo 'Group was not found.'; }

		//return 1;
	}
}
