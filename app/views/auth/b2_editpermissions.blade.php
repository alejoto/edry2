<table class="table table-hover table-condensed">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach(Permission::get() as $p)
		<tr id='rowpermission{{$p->id}}'>
			<td>
				<div id="permissionname{{$p->id}}">
					{{$p->permissionname}}
				</div>
				<div class="hmdhide" id="permissionnameinput{{$p->id}}">
					<input type="text" value='{{$p->permissionname}}' id='editedvalueforpermissionname{{$p->id}}'>
				</div>
			</td>
			<td>
				<div id="permissiondescription{{$p->id}}">
					{{$p->permissiondescription}}
				</div>
				<div class='hmdhide' id="permissiondescriptioninput{{$p->id}}">
					<input type="text" value='{{$p->permissiondescription}}' id='editedvalueforpermissiondescription{{$p->id}}'>
				</div>
			</td>
			<td>
				<a class='editpermission' href="" id='editpermission{{$p->id}}'>Edit</a>
				<spam href="" id="editpermissionbuttons{{$p->id}}" class="hmdhide">
					<a href="" id="editpermissionconfirm{{$p->id}}">Confirm</a>
					<a href="" id="editpermissioncancel{{$p->id}}">Cancel</a>
				</spam>
			</td>
			<td>
				<a href="" id='deletepermission{{$p->id}}'>Delete</a>
				<div id="deletepermissiongroup{{$p->id}}" class="hmdhide">
					<a href="" id="deletepermissionconfirm{{$p->id}}">Confirm</a>
					<a href="" id="deletepermissioncancel{{$p->id}}">Cancel</a>
				</div>
			</td>
		</tr>
	@endforeach
</table>
