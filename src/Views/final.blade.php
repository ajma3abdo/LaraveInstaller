@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.final.title'))

@section('content')
<div class="install-card">
    <div class="success-animation">
        <div class="success-circle">
            <svg width="42" height="42" viewBox="0 0 24 24" fill="none"
                stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <h2 class="success-title">{{ __('laravel_installer.final.title') }}</h2>
        <p class="success-desc">{{ __('laravel_installer.final.desc') }}</p>
        <a href="{{ config('installer.final.redirect_after_installation_url') }}" class="btn btn-primary">
            {{ __('laravel_installer.final.home_page') }}
        </a>
    </div>
</div>
@endsection
