@extends('layouts.app')
@if(Auth::check())
    @section('admin-panel')
        @include('admin.panel')
    @stop
@endif
@section('header')
    @include('header')
@stop
@section('registration')
    @include('landing.register')
@stop



@section('footer')
    @include('footer')
@stop


