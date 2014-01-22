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
}