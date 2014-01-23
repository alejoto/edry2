@extends('layouts.base')

@section('content')

All auth process in only one page (this) in order to unify in dry4
<br>
@include('auth.b1_definepermissions')

@include('auth.b2_editpermissions')

@include('auth.b3_creategroup')

@include('auth.b4_editgroup')

@include('auth.b5_usersubscription')

@include('auth.b6_basicuseredition')

@include('auth.b7_loginandpwdreset')


<br><br>
@stop


