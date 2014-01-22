$(function(){

	/*Add new permission type*/
	$('#addpermissiontype').click(function(e){
		e.preventDefault();
		var pss=$('#pss').val();
		var pssdesc=$('#pssdesc').val();
		if (pss.trim()=='') {
			$('#newpermissionresult').html('Add a name to this permission')
		}
		else {
			var base=$('#base').html();
			$.post(base+'/ajaxauth/permissionnew',{pss:pss,pssdesc:pssdesc},function(d){
				var mss='';
				if (d==1) {
					$('#pss').val('');
					$('#pssdesc').val('');
				}
				else if (d==2) {
					mss='permission type already exists';
					$('#pss').focus();
				}
				$('#newpermissionresult').html(mss);
			});
		}
	});

	//function grouphide();

	/*Edit permission*/

	function openeditpermission(id) {
		$('#editpermission'+id).click(function(e){
			e.preventDefault();
			$('#permissionname'+id).hide();
			$('#permissionnameinput'+id).show();
			$('#permissiondescription'+id).hide();
			$('#permissiondescriptioninput'+id).show();
			$('#editpermission'+id).hide();
			$('#editpermissionbuttons'+id).show();
			$('#deletepermission'+id).hide();
		});
	}

	function restorepermissionrow(id){
		$('#permissionname'+id).show();
		$('#permissionnameinput'+id).hide();
		$('#permissiondescription'+id).show();
		$('#permissiondescriptioninput'+id).hide();
		$('#editpermission'+id).show();
		$('#editpermissionbuttons'+id).hide();
		$('#deletepermission'+id).show();
	}

	function canceleditpermission(id) {
		$('#editpermissioncancel'+id).click(function(e){
			e.preventDefault();
			restorepermissionrow(id);
			$('#editedvalueforpermissionname'+id).val($('#permissionname'+id).html().trim());
			$('#editedvalueforpermissiondescription'+id).val($('#permissiondescription'+id).html().trim());
		});
	}

	function confirmeditpermission(id) {
		$('#editpermissionconfirm'+id).click(function(e){
			e.preventDefault();
			var name=$('#editedvalueforpermissionname'+id).val().trim();
			var descp=$('#editedvalueforpermissiondescription'+id).val().trim();
			if (name!='') {
				var base=$('#base').html();
				$.post(base+'/ajaxauth/permissionedit',{id:id,name:name,descp:descp},function(d){
					restorepermissionrow(id);
					$('#permissionname'+id).html(name);
					$('#permissiondescription'+id).html(descp);
				});
			}

		});
	}

	$('.editpermission').each(function(){
		var id=$(this).attr('id');
		id=id.replace('editpermission','');
		openeditpermission(id);
		canceleditpermission(id);
		confirmeditpermission(id);
		opendeletepermission(id);
		deletepermissioncancel(id);
		deletepermissionconfirm(id);
	});

	/*Delete permission
	Advice: delete actions are multiloaded with the $('.editpermission').each(function ... jquery function
	*/
	function opendeletepermission(id) {
		$('#deletepermission'+id).click(function(e){
			e.preventDefault();
			$(this).hide();
			$('#deletepermissiongroup'+id).show();
		});
	}

	function deletepermissioncancel(id){
		$('#deletepermissioncancel'+id).click(function(e){
			e.preventDefault();
			$('#deletepermission'+id).show();
			$('#deletepermissiongroup'+id).hide();
		});
	}

	function deletepermissionconfirm(id){
		$('#deletepermissionconfirm'+id).click(function(e){
			e.preventDefault();
			var base=$('#base').html();
			$.post(base+'/ajaxauth/deletepermission',{id:id},function(d){
				$('#rowpermission'+id).hide('fast');
			});
		});
	}

	/*Function for counting substring ocurrences in string*/
	function occurrences(string, substring){
	    var n=0;
	    var pos=0;

	    while(true){
	        pos=string.indexOf(substring,pos);
	        if(pos!=-1){ n++; pos+=substring.length;}
	        else{break;}
	    }
	    return(n);
	}
	

	/*Adding permissions to group that is going to be created*/
	function addpermissionfornewgroup(id){
		$('#permissiontogroup'+id).click(function(){
			$('#creategroupresult').html('');
			var pms='';
			$('.permissiontogroup:checked').each(function(){
				pms=pms+','+$(this).attr('permission');
			});
			$('#grouppermission').val(pms.substring(1));

		});
	}

	$('.permissiontogroup').each(function(){
		var id=$(this).attr('id');
		id=id.replace('permissiontogroup','');
		addpermissionfornewgroup(id);
	});
	
	/*Create group*/
	$('#creategroup').click(function(e){
		e.preventDefault();
		var ngroup=$('#ngroup').val().trim();
		var grouppermission=$('#grouppermission').val().trim();
		var base=$('#base').html();
		$.post(base+'/ajaxauth/groupnew',{ngroup:ngroup,grouppermission:grouppermission},function(d){
			$('#creategroupresult').html(d);
			if (d=='') {
				$('#ngroup').val('');
				$('#grouppermission').val('');
				$('.permissiontogroup').prop('checked', false);
			}
		});
	});

	function groupedit(id) {
		$('#groupedit'+id).click(function(e){
			e.preventDefault();
			$('#changegrouppermissions'+id).show('fast');
			$('#grouppermissions'+id).hide('fast');
			$('#groupeditbuttons'+id).show();
			$(this).hide();
		});
	}

	function cancelgroupedit(id) {
		$('#cancelgroupedit'+id).click(function(e){
			e.preventDefault();
			$('#changegrouppermissions'+id).hide('fast');
			$('#grouppermissions'+id).show('fast');
			$('#groupeditbuttons'+id).hide();
			$('#groupedit'+id).show();
		});
	}

	$('.groupedit').each(function(){
		var id=$(this).attr('id');
		id=id.replace('groupedit','');
		groupedit(id);
		cancelgroupedit(id);
	});

	/*$('.permissiongroup').each(function(){
		
	});*/

	$('.parentgroupeditor').each(function(){
		var parent_id=$(this).attr('id');
		parent_id=parent_id.replace('changegrouppermissions','');
		function savechangesindrouppermissions(parent_id,id) {
			$('#confirmgroupedit'+parent_id).click(function(e){
				e.preventDefault();
				var name=$('#gnameinput'+parent_id).val();
				$('#checkedpermissions'+parent_id).html('');
				var pms='';
				var nopms='';
				$('.permissiongroup'+parent_id).each(function(){
					if ($(this).is(':checked')) {
						pms=pms+','+$(this).attr('permission');
					}
					else {
						nopms=nopms+','+$(this).attr('permission');
					}
				});
				pms=pms.substring(1);
				nopms=nopms.substring(1);
				//$('#checkedpermissions'+parent_id).html(nopms);
				var base=$('#base').html();
				$.post(base+'/ajaxauth/groupedit',{parent_id:parent_id,name:name,pms:pms,nopms:nopms},function(d){
					$('#checkedpermissions'+parent_id).html(d);
					if (d=='') {
						location.reload();
					}
				});
			});
		}
		
		$('.permissiongroup'+parent_id).each(function(){
			var id=$(this).attr('id');
			id=id.replace('editpermissiongroup','');
			savechangesindrouppermissions(parent_id,id);
		});
		//
	});
});