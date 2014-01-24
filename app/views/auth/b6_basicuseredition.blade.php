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
<table class="table table-condensed table-hover">
	<tr>
		<th class="span3">User id</th>
		<th class="span2">Group</th>
		<th class="span3">Permissions</th>
		<th class="span2">Action</th>
	</tr>
	@foreach(Sentry::findAllUsers() as $u)
		<tr>
			<td class="span3">
				{{$u->email}}
			</td>
			<td class="span2">
				{{$u->groups()->first()->name}}
			</td>
			<td class="span3"><?php $comma=''; ?>
				@foreach($u->groups()->first()->permissions as $k=>$p)
					@if($p==1)
						{{$comma.$k}}
					@endif
					<?php $comma=', '; ?>
				@endforeach
			</td>
			<td>
				Edit
			</td>
		</tr>
	@endforeach
</table>
@foreach(Sentry::findAllUsers() as $u)
	 |
	@foreach($u->groups()->get() as $g)
		{{$g->name}}
		<?php $preselected=$g->name; ?>
	@endforeach

	<select name="" id="">
		<option value=""></option>
		@foreach(Sentry::findAllGroups() as $ag)
			<?php $selected; if ($ag->name==$preselected) {$selected='selected'; } else $selected='';?>
			<option {{$selected}}>{{$ag->name}}</option>
		@endforeach
	</select>
	 
	<br>

@endforeach

<br>  <br>


