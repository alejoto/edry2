<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>{{$title}}</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        {{HTML::style('assets/css/bootstrap.css');}}
        {{HTML::style('assets/css/hmd.css');}}
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
        <style type="text/css">
               
        </style>
    </head>
<body>
    <div id="base" class='hmdhide'>{{ URL::to('/'); }}</div>
    @yield('main')


    {{HTML::script('assets/js/jquery-1.10.2.min.js');}}
    {{HTML::script('assets/js/bootstrap.min.js');}}
    {{HTML::script('assets/js/hmdv1.js');}}

    @yield('scripts')
</body>
</html>