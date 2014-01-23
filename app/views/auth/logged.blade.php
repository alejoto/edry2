@extends('layouts.base')

@section('content')
<div class="row-fluid">
	<div class="span12">
		This page is only visible when user is logged in.
		<br>
		<br>
		User data <br>
	</div>
</div>
<pre>
&lt;?php
$user = Sentry::getUser(); //logged user
echo $logged->first_name; //Echoing logged user name
echo $logged->last_name; //Echoing logged user name
?&gt;
//Echoing group name:
foreach($logged->groups()->get() as $g){ echo g->name; }
//Echoing permissions on group:
foreach($logged->groups()->get() as $g){ 
	foreach($g->permissions as $k=>$v) {
		if($v==1){ echo $k; // the array key is the name of the permission; $value as 1 or 0 is allowed or not }
	}
}
</pre>
<?php  $logged=$user = Sentry::getUser(); ?>

<br>
<div class="row-fluid">
	<div class="span4">
		Name: {{$logged->first_name}} {{$logged->last_name}}
	</div>
	<div class="span4">
		Email (non editable): {{$logged->email}} 
	</div>
	<div class="span4">
		Group and permissions: 
		@foreach($logged->groups()->get() as $g)
			{{$g->name}} :
			@foreach($g->permissions as $k=>$v)
				@if($v==1)
					{{$k}} . 
				@endif
			@endforeach
		@endforeach
	</div>
</div>
<hr>
<input type="password" id='changepassword'> Change password <br>
<input type="password" id='matchchangepassword'> Confirm <br>
<div id="changepasswordresult"></div>
<button id="confirmchangingpassword" uid='{{$logged->id}}'>Change password</button>

<hr>
<input type="text" id="updateuserfirst_name" value='{{$logged->first_name}}'> First name <br>
<input type="text" id="updateuserlast_name" value='{{$logged->last_name}}'> Last name
<br>
<div id="updateusernameresult"></div>
<button id="confirmupdatingusername" uid='{{$logged->id}}'>Update name</button>
<br>
<hr>
<br>
Reset forgotten password: copy the method working on tasking easy <br>



<br>
<a href="{{URL::to('auth/logout')}}" id="log_out">Log out</a>
@stop