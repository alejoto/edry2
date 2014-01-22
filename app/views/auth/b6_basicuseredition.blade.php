<h1 id='editgrouptitle'>Basic user edition</h1>

1. By id, this is, logged user can edit his own profile: <br>
Id of logged user (as example) 1. <br>
method for retrieving logged user id
<pre>
&lt;?php
$user = Sentry::getUser();
$id=$user->id;
?&gt;
</pre>

{{Sentry::getUser()}}
<br>
<br>
@foreach(Sentry::findAllUsers() as $u)
	{{$u->email}} <br>
@endforeach

<br>  <br>

logging in
<br>

<input id='emaillogin' type="email"> Email <br>
<input id='pwslogin' type="password"> Password <br>
<div id="loginresult"></div>
<button id="login">Log in</button>
