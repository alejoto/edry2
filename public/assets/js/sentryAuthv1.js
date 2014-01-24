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
			$('#groupeditnamelabel'+id).hide();
			$('#groupeditnameinput'+id).show();
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
			$('#groupeditnamelabel'+id).show();
			$('#groupeditnameinput'+id).hide();
		});
	}

	function groupdeletebuttons(id){
		$('#groupdelete'+id).click(function(e){
			e.preventDefault();
			$('#groupdeletebuttons'+id).show();
			$('#groupdelete'+id).hide();
		});
	}

	function cancelgroupdelete(id){
		$('#cancelgroupdelete'+id).click(function(e){
			e.preventDefault();
			$('#groupdeletebuttons'+id).hide();
			$('#groupdelete'+id).show();
		});
	}

	function confirmgroupdelete(id){
		$('#confirmgroupdelete'+id).click(function(e){
			e.preventDefault();
			var base=$('#base').html();
			$.post(base+'/ajaxauth/groupdelete',{id:id},function(d){
				$('#groupeditnamelabel'+id).show();
				$('#groupeditnamelabel'+id).html(d);
			});
		});
	}

	$('.groupedit').each(function(){
		var id=$(this).attr('id');
		id=id.replace('groupedit','');
		groupedit(id);
		cancelgroupedit(id);
		groupdeletebuttons(id);
		cancelgroupdelete(id);
		confirmgroupdelete(id);
	});



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
	});

	/*Subscribe*/

	$('#subscribe').click(function(e){
		e.preventDefault();
		var semail =$('#semail').val();
		var spwd=$('#spwd').val();
		var base=$('#base').html();
		$.post(base+'/ajaxauth/subscribe',{semail:semail,spwd:spwd},function(d){
			$('#subscriberesult').html(d);
		});
	});

	/*Log in*/
	$('#login').click(function(e){
		e.preventDefault();
		var	emaillogin=$('#emaillogin').val();
		var pwslogin=$('#pwslogin').val();
		var base=$('#base').html();
		$.post(base+'/ajaxauth/login',{emaillogin:emaillogin,pwslogin:pwslogin},function(d){
			if (d=='') {
				window.location.href=base+'/auth/logged';
			}
			else {
				$('#loginresult').html(d);
			}
		});
	});

	//change password
	$('#confirmchangingpassword').click(function(e){
		e.preventDefault();
		var id=$(this).attr('uid');
		var pwd=$('#changepassword').val();
		var pwd2=$('#matchchangepassword').val();
		if (pwd==pwd2) {
			var base=$('#base').html();
			$.post(base+'/ajaxauth/changepassword',{id:id,pwd:pwd},function(d){
				if (d==1) {
					$('#changepasswordresult').html('Password succesfully changed');
					$('#changepassword').val('');
					$('#matchchangepassword').val('');
				}
				else if (d==2) {}
				else {
					$('#changepasswordresult').html(d);
				}
			});
		}
		else {
			$('#changepasswordresult').html('Password and confirmation do not match.');
		}	
	});

	//Update user name
	$('#confirmupdatingusername').click(function(e){
		e.preventDefault();
		var id=$(this).attr('uid');
		var first_name=$('#updateuserfirst_name').val();
		var last_name=$('#updateuserlast_name').val();
		var base=$('#base').html();
		$.post(base+'/ajaxauth/updateusername',{id:id,first_name:first_name,last_name:last_name},function(d){
			//
		});
	});

	//Request for resetting password 
	$('#resetpassword').click(function(e){
		e.preventDefault();
		//$('#resetpassword_label').hide();
		$('#activate_subscribe_form').hide('fast');
		//$('#start_subscribe').hide('fast');
		$('#resetpasswordrequest').show('fast');
		
	});

	valid_email('email_to_be_reseted','email_to_be_reseted_msg');

	//Cancel request for resetting password
	$('#cancel_password_reset').click(function(e){
		e.preventDefault();
		$('#email_to_be_reseted').val('');
		$('#confirm_email_to_be_reseted').val('');
		$('#resetpassword_label').html('');
		//$('#start_subscribe').show('fast');
		$('#resetpasswordrequest').hide('fast');
	});

	//Reset password
	$('#confirm_reset_password').click(function(e){
		e.preventDefault();
		var email=$('#email_to_be_reseted').val();
		var confirm=$('#confirm_email_to_be_reseted').val();
		if (email.trim()=='') {
			$('#resetpassword_label').html('Enter email please');
		}
		else if (email!=confirm) {
			$('#resetpassword_label').html('Entered email does not match with confirmation.');
		}
		else //if (email==confirm&&email!='') 
		{
			$('#resetpassword_label').html('');
			$('#email_to_be_reseted').hide();
			$('#confirm_email_to_be_reseted').hide();
			$('#reset_pwd_btns').hide();
			$('#progress_bar_for_reset_pwd').show();
			var base=$('#base').html();
			$.post(base+'/ajaxauth/resetpwd',{email:email},function(d){
				if (d==1) {
					$('#email_to_be_reseted').val('');
					$('#confirm_email_to_be_reseted').val('');
					$('#resetpassword_label').html('PASSWORD RESET: '
						+'Please follow the instructions that were sent to your email '
						+'in order to reset your password.');

					$('#email_to_be_reseted').show();
					$('#confirm_email_to_be_reseted').show();
					$('#progress_bar_for_reset_pwd').hide();
					$('#reset_pwd_btns').show();

					//$('#start_subscribe').show('fast');
					$('#resetpasswordrequest').hide('fast');
				}
				else if (d==2) {
					$('#email_does_not_exist').html('Sorry, email was not '
						+'found in our database. Try again or subscribe '
						+'as new user.');
					$('#email_to_be_reseted').show();
					$('#confirm_email_to_be_reseted').show();
					$('#progress_bar_for_reset_pwd').hide();
					$('#reset_pwd_btns').show();
				}
			});
		}	
	});
	
	//users on group edition
	function editusergroup(id) {
		$('#editusergroup'+id).click(function(e){
			e.preventDefault();
			$('#usergroupactive'+id).hide();
			$('#usergrouplist'+id).show();
			$(this).hide();
			$('#editusergroupbuttons'+id).show();
		});
	}

	function canceleditusergroup(id) {
		$('#canceleditusergroup'+id).click(function(e){
			e.preventDefault();
			$('#usergroupactive'+id).show();
			$('#usergrouplist'+id).hide();
			$('#editusergroup'+id).show();
			$('#editusergroupbuttons'+id).hide();
		});
	}

	function confirmeditusergroup(id){
		$('#confirmeditusergroup'+id).click(function(e){
			e.preventDefault();
			var group=$('#usergroupselect'+id).val();
			var base=$('#base').html();
			$.post(base+'/ajaxauth/editusergroup',{id:id,group:group},function(d){
				if (d==1) {
					location.reload();
				}
				//$('#confirmeditusergroup'+id).hide();
			});
		});
	}

	$('.editusergroup').each(function(){
		var id=$(this).attr('id')
		id=id.replace('editusergroup','');
		editusergroup(id);
		canceleditusergroup(id);
		confirmeditusergroup(id);
	});
});