<h1>Create new group</h1>
<pre>
controller: ajax
AJAX URL: '/ajax/groupnew'
AJAX method: post
class method: postGroupnew
Standard crossover names
	ngroup
	grouppermission
</pre>
<input type="text" id='ngroup'> Group name <br>

<br>
<?php $i=1; ?>
<div class="row-fluid">
@foreach(Permission::get() as $p)
	
	<div class="span3">
		<input type="checkbox" 
		permission='{{$p->permissionname}}'
		class='permissiontogroup' 
		id='permissiontogroup{{$p->id}}'>
		{{$p->permissionname}} 
	</div>
	
	@if($i==4)
	</div><div class="row-fluid">
	<?php $i=0; ?>
	@endif
	<?php $i++; ?>
@endforeach
</div>

<div class="hmdhide">
	<input type="text" id='grouppermission'> Permissions (separated with comma)<br>
</div>
<button id="creategroup">create group</button>
<div id="creategroupresult"></div>
<br>



