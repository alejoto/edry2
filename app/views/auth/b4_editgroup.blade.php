<h1 id='editgrouptitle'>Edit group</h1>

<table class='table table-hover'>
	<tr>
		<th class='span2'>name</th>
		<th class='span8'>permissions</th>
		<th class="span1">Edit</th>
		<th class="span1">Delete</th>
	</tr>
	@foreach(Sentry::findAllGroups() as $g)
		<tr>
			<td>
				<div id="groupeditnamelabel{{$g->id}}">
					{{$g->name}}
				</div>
				<div id="groupeditnameinput{{$g->id}}" class="hmdhide">
					<input type="text" id="gnameinput{{$g->id}}" value='{{$g->name}}'>
				</div>
				
			</td>
			<td>
				<div id="grouppermissions{{$g->id}}">
					<?php $i=0; ?>
					@foreach($g->permissions as $k=>$p)
						@if($p==1)
							@if($i!=0)
							-
							@endif
						{{$k}}
						@endif
						
						<?php 
						if ($p==1) {
							$arraykeys[$i]=$k;
						}
						$i++; ?>
					@endforeach
				</div>
				<div class="hmdhide parentgroupeditor" id='changegrouppermissions{{$g->id}}'>
					<div class="row-fluid">
						<?php $i=1; ?>
						@foreach(Permission::get() as $pms)
							<?php 
							$checked='';
							$classchecked='muted';
							if (in_array($pms->permissionname, $arraykeys)) {
							 	$checked='checked';
							 	$classchecked='';
							 } ?>
							<div class="span3 {{$classchecked}}">
								
								<input 
								type="checkbox" 
								id='editpermissiongroup{{$g->id.$pms->id}}'
								permission='{{$pms->permissionname}}'
								{{$checked}} 
								class='permissiongroup{{$g->id}}'> 
								{{$pms->permissionname}}
							</div>
							
							<?php
							if ($i==4) { ?>
							</div><div class='row-fluid'>
							<?php
							$i=0;
							}
							$i++;
							?>
						@endforeach
					</div>
						
				</div>
			</td>
			<td>
				<a href="" class='groupedit' id='groupedit{{$g->id}}'>Edit</a>
				<div id="groupeditbuttons{{$g->id}}" class='hmdhide'>
					<a href="" id="cancelgroupedit{{$g->id}}">Cancel</a>
					<a href="" id="confirmgroupedit{{$g->id}}">Save</a>
					<div id="checkedpermissions{{$g->id}}" ></div>
				</div>
				
			</td>
			<td>
				<a href="" id='groupdelete{{$g->id}}'>Delete</a>
				<div id="groupdeletebuttons{{$g->id}}" class="hmdhide">
					<a href="" id='confirmgroupdelete{{$g->id}}'>confirm</a>
					<a href="" id='cancelgroupdelete{{$g->id}}'>cancel</a>
				</div>
			</td>
		</tr>
		<?php 
		$arraykeys=array();
		?>
	@endforeach
</table>