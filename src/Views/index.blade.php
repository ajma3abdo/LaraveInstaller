@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.welcome'))

@section('content')
    <div class="d-flex justify-content-center w-full ">
        @if (config('installer.licence.enable'))
            <a class="btn btn-primary" href="{{route('install::licence')}}">
                {{__('laravel_installer.start')}}
            </a>
        @else
            <a class="btn btn-primary" href="{{route('install::permissions')}}">
                {{__('laravel_installer.start')}}
            </a>
        @endif
    </div>
@endsection