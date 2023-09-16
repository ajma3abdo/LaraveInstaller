@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.final.title'))

@section('content')   
    <div class="d-flex justify-content-center mt-4"> 
        <h1>{{__('laravel_installer.final.desc')}}</h1>
    </div>
    <div class="d-flex justify-content-center mt-4"> 
        <a href="{{config('installer.final.redirect_after_installation_url')}}" class="btn btn-primary">{{__('laravel_installer.final.home_page')}}</a>
    </div>
@endsection