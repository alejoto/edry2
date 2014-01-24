@extends('templates.resettemplate')
@section('main')


<div class="row-fluid">
    <div class="offset3 span6">
        <h1>Password reset</h1>
        @if(isset($_GET['mssg']))
            @if($_GET['mssg']=='wrong')
            <div class="alert alert-error">Wrong reset key, try reseting your password again</div>
            @elseif ($_GET['mssg']=='noexist') 
            <div class="alert alert-error">The entered email does not exist in our database, please verify</div>
            @endif
        @endif
            
        
        
		{{ Form::open(array('url' => 'ajaxauth/changepwd')) }}
			<div class="row-fluid">
				<div class="span4 text-right">Confirm your email</div>
				<div class="span8">
					<input type="email" class="span12" 
					name='confirm_email' id='confirm_email' 
                    
                    >
				</div>
				<div class="span12 text-error" id="resetpwd_email_msg"></div>
			</div>
			<div class="row-fluid">
                    <div class="span4 text-right">New password</div>
                    <div class="span8">
                            <input class="span12" 
                            type="password" 
                            name='resetpwd_new_password' 
                            id='resetpwd_new_password'
                            value=''>
                    </div>
                    <div class="span4" id="error_msg_resetpwd"></div>
            </div>
            <div class="row-fluid">
                    <div class="span4 text-right">confirm password</div>
                    <div class="span8">
                        <input class="span12" 
                        type="password" 
                        name='' id='resetpwd_new_password_confirm'>
					</div>
            </div>
            
                <div class="">
                    <input type="hiden"
                    class='hide' 
                    name='get_reset_key'
                    id="get_reset_key" 
                    value="{{$_GET['key']}}">
                    
                </div>
            
                    
            <div class="row">
                    <div class="offset2 span10">
                            <input type='submit' 
                            id='do_resetpwd' 
                            value='Set new password' 
                            class='btn'/>
                    </div>
            </div>
            <hr>
			
        {{ Form::close() }}
        <div class="row">
            <div class="offset2 span10">
                <a href="{{ url('/')}}">Tasking Easy</a> site
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
{{HTML::script('assets/js/resetpwd.js');}}    
@stop
