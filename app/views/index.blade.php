@extends('layouts.base')
@section('sidebar')
@stop
@section('content')
Wellcome.  If you can see this page you have succesfully installed:
    <ul>
    	<li>Laravel framework version 4.0</li>
    	<li>jQuery version 10.2</li>
        <li>hmd.css (some css classes created by HMD)</li>
    	<li>Datepicker bootstrap <input type="text" class='datepicker'></li>
    	<li>Timepicker bootstrap <input type="text" class='timepicker'></li>
    	<li>HMD validator (this example accepts only numbers)<input type="text" id='onlynumbers'></li>
    	<li>Twitter Bootstrap version 2.3</li>
        <li>Standard AjaxController (route 'ajax') for all post requests</li>
        <li>amCharts version 3.0</li>
    	<li>Stylish-portfolio.zip: one of the best twitter bootstrap 3.0 templates ever made (support docs).</li>
    	<li>Generator (command line tools for laravel)</li>
        <li>Sentry Auth system BEFORE GOING TO THIS LINK YOU MUST RUN A MIGRATION! <a href="{{URL::to('auth')}}">go to this link</a></li>
    </ul>
    this also has the intervention/image package. <br>
    Mode of use: http://intervention.olivervogel.net/image<br>
    Open a php tag <br>
    Create a name of edited image (not equal to original as it will replace it). <br>
    <pre>
    &lt;?php
    $original='MedjugorjeMessage.jpg';
    $imgpath='assets/img/';
    $displayo=URL::to($imgpath.$original);
    $newimg='smallermedjugorje.jpg';
    // resize the image to a width of 100 and constrain aspect ratio (auto height)
	$img = Image::make('public/'.$imgpath.$original)->resize(100, null, true)->save('public/'.$imgpath.$newimg);
	$displayn=URL::to($imgpath.$newimg);
?&gt;
    </pre>
    <?php
    $original='MedjugorjeMessage.jpg';
    $imgpath='assets/img/';
    $displayo=URL::to($imgpath.$original);
    $newimg='smallermedjugorje.jpg';

    // resize the image to a width of 100 and constrain aspect ratio (auto height)
	//$img = Image::make('public/'.$imgpath.$original)->resize(100, null, true)->save('public/'.$imgpath.$newimg);
	//$displayn=URL::to($imgpath.$newimg);
    ?>
    original picture <code>&lt;img src="{$displayo}" alt=""&gt;</code>
    <br>
    <img src="{{$displayo}}" > <img src="{{$displayo}}" class='img-rounded'> <img src="{{$displayo}}" class='img-circle'>
    <br>
    New picture original picture <code>&lt;img src="{$displayn}" alt=""&gt;</code>
    <br>
    <img src="{{--$displayn--}}" > <img src="{{--$displayn--}}" class='img-polaroid'>
    <br>
    <br>
    <br>


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