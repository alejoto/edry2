@extends('layouts.base')

@section('content')
This page is only visible when user is logged in.
<br>
<a href="{{URL::to('auth/logout')}}" id="log_out">Log out</a>
@stop