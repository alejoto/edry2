log in
<br>

<input id='emaillogin' type="email"> Email <br>
<input id='pwslogin' type="password"> Password <br>
<div id="loginresult"></div>
<button id="login">Log in</button>
<hr>
Forgot your password?  not to be worried about. 
<br>
<a href="#" id='resetpassword' >Click here!</a>

<div id="resetpasswordrequest" class='hmdhide'>
	PASSWORD RESET
	<br>
	Enter email <input type="text" placeholder='email' id='email_to_be_reseted'>
	<spam id="email_to_be_reseted_msg"></spam>
	<br>
	Confirm &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" placeholder='confirm email' id='confirm_email_to_be_reseted'>
	<br>
	<div id="reset_pwd_btns">
		<a href="#" class='btn btn-primary' id='confirm_reset_password'>RESET PASSWORD</a> |
		<a href="#" class='btn btn-danger' id='cancel_password_reset'>Cancel</a>
	</div>
	
	<spam id="email_does_not_exist"></spam>
	<spam id="progress_bar_for_reset_pwd" class='hmdhide'>
		<img
		src="{{asset('assets/img/progressBar.gif')}}" 
		alt="" id=''>
		Wait while system sends reset key to your email
	</spam>
</div>
<div id="resetpassword_label"></div>
Warning: mail configuration MUST BE PROPERLY SET in order to enable this password reset method. <br>
Check app/config/mail.php
<br>
<br>
<br>