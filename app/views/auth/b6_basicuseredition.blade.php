<h1 id='editgrouptitle'>User administration</h1>
Note: updating user name and password depends on each user.  Admin can only change groups to each user.
<br>
Script for retrieving list of all current users
<pre>
&lt;?php
$user = Sentry::getUser();
$id=$user->id;
?&gt;
</pre>


<br>
<b>List of users</b>
<br>

@foreach(Sentry::findAllUsers() as $u)
	{{$u->email}} <br>
@endforeach

<br>  <br>


