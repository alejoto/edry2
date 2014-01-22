<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	{{HTML::style('assets/css/bootstrap.css');}}
	{{HTML::style('assets/css/bootstrap-responsive.css');}}
	{{HTML::style('assets/css/sticky-footer-navbar.css');}}
	{{HTML::style('assets/css/datepicker.css');}} 
	{{HTML::style('assets/css/bootstrap-timepicker.css');}}
	{{HTML::style('assets/css/hmd.css');}} 

</head>
    <body>
    	<div class='hide'  id='base'>{{URL::to('/')}}</div>
    	<div id="wrap">
    		@include('layouts.navbar')
	    		

	        <div class="container">
	        	@section('sidebar')
		        @show
		        
	            @yield('content')
	        </div>
	        <div id="push"></div>
	    </div>
	    @include('layouts.footer')

    </body>
</html>

{{--Scripts--}}
{{HTML::script('assets/js/jquery-1.10.2.min.js');}}
{{HTML::script('assets/js/bootstrap.min.js');}}
{{HTML::script('assets/js/hmdv1.js');}}
{{HTML::script('assets/js/hmd_valid.js');}}
{{HTML::script('assets/js/bootstrap-datepicker.js');}}
{{HTML::script('assets/js/bootstrap-timepicker.js');}}
{{HTML::script('assets/js/sentryAuthv1.js');}}

{{--Put nexts scripts only on pages that will do charts, inside 'scripts' section--}}
{{--HTML::script('assets/js/amcharts_3.1.1/amcharts/amcharts.js');--}} 
{{--HTML::script('assets/js/amcharts_3.1.1/amcharts/serial.js');--}} 
{{--HTML::script('assets/js/chartbuilderV1.js');--}}

@section('scripts')
@show
