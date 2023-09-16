@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.database.title'))

@section('content')    
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
        @if (config('installer.admin.enable'))
            <a href="{{route('install::admin')}}" class="btn btn-primary">{{__('laravel_installer.environment.next')}}</a>
        @else
            <a href="{{route('install::final')}}" class="btn btn-primary">{{__('laravel_installer.environment.next')}}</a>
        @endif
    </div>

@endsection