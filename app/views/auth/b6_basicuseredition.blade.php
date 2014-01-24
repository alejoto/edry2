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
		<th class="span2">User id</th>
		<th class="span6">Group <spam class="text-info">(Permissions)</spam></th>
		<th class="span1">Edit</th>
		<th class="span1">Delete</th>
	</tr>
	@foreach(Sentry::findAllUsers() as $u)
		<tr>
			<td class="span2">
				<div id="userid{{$u->id}}">{{$u->email}}</div>
				
			</td>
			<td class="span4">
				<div id="usergroupactive{{$u->id}}">
					{{$u->groups()->first()->name}}
					<spam class="text-info">(
						<?php $comma=''; ?>
						@foreach($u->groups()->first()->permissions as $k=>$p)
							@if($p==1)
								{{$comma.$k}}
							@endif
							<?php $comma=', '; ?>
						@endforeach
					)</spam>
				</div>
				<div id="usergrouplist{{$u->id}}" class='hmdhide'>
					<select name="" id="usergroupselect{{$u->id}}">
						<option value=""></option>
						<?php $preselected=$u->groups()->first()->name; ?>
						@foreach(Sentry::findAllGroups() as $ag)
							<?php $selected; if ($ag->name==$preselected) {$selected='selected'; } else $selected='';?>
							<option {{$selected}} value='{{$ag->id}}'>
								{{$ag->name}} (
									<?php $comma=''; ?>
									@foreach($ag->permissions as $k=>$p)
										@if($p==1)
											{{$comma.$k}}
										@endif
										<?php $comma=', '; ?>
									@endforeach
								)
							</option>
						@endforeach
					</select>
				</div>
			</td>
			<td>
				<a class='editusergroup' id='editusergroup{{$u->id}}' href="">Edit</a>
				<div id="editusergroupbuttons{{$u->id}}" class="hmdhide">
					<a id='canceleditusergroup{{$u->id}}' href="">Cancel</a>
					<a id='confirmeditusergroup{{$u->id}}' href="" >Update</a>
				</div>
			</td>
			<td>Delete</td>
		</tr>
	@endforeach
</table>
<br>
<br>
