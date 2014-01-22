@extends('layouts.base')
@section('sidebar')
@stop
@section('content')

All auth process in only one page (this) in order to unify in dry4
<br>
@include('auth.b1_definepermissions')

@include('auth.b2_editpermissions')

@include('auth.b3_creategroup')

@include('auth.b4_editgroup')




<h1>Subscription</h1>
<pre>
controller: ajax
AJAX URL: '/ajax/subscribe'
AJAX method: post
Class method: postSubscribe 
Standard crossover name
	email: semail
	password: spwd
	button: subscribe
(first letter corresponds to subscribe)
</pre>
<input type="text" id="semail" name='semail'>email <br>
<input type="text" id="spwd" name='spwd'> Password <br>
<button id="subscribe">subscribe</button>
<div id="subscriberesult"></div>



@stop

@section('scripts')
<script>
$(function(){
	$('#subscribe').click(function(e){
		e.preventDefault();
		var semail =$('#semail').val();
		var spwd=$('#spwd').val();
		var base=$('#base').html();
		$.post(base+'/ajax/subscribe',{semail:semail,spwd:spwd},function(d){
			$('#subscriberesult').html(d);
		});
	});
		
});
	
</script>
@stop
