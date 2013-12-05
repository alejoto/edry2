@extends('layouts.base')
@section('sidebar')
@stop
@section('content')
Wellcome.  If you can see this page you have succesfully installed:
    <ul>
    	<li>Laravel framework version 4.0</li>
    	<li>jQuery version 10.2</li>
    	<li>Datepicker bootstrap <input type="text" class='datepicker'></li>
    	<li>Timepicker bootstrap <input type="text" class='timepicker'></li>
    	<li>HMD validator (this example accepts only numbers)<input type="text" id='onlynumbers'></li>
    	<li>Twitter Bootstrap version 2.3</li>
    	<li>amCharts version 3.0</li>
    	<li>Generator (command line tools for laravel)</li>
    </ul>
We wish you a nice work today.
@stop

@section('scripts')
<script type="text/javascript">
	$('.timepicker').timepicker({
		template: 'dropdown',
		showSeconds: true,
		minuteStep: 30,
		//secondStep: 0,
		showInputs: false,
		disableFocus: true,
		defaultTime: '8:00:00',
		showMeridian: false
	});
	$(function(){
		$('.datepicker').datepicker({
			format : 	'yyyy/mm/dd'
		});
		hmdfloatnumb($('#onlynumbers'));
	});
	
</script>
@stop