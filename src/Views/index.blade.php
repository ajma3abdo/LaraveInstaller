@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.welcome'))

@section('content')
<div class="install-card">
    <div class="welcome-hero">
        <div class="welcome-icon">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none"
                stroke="#f59e0b" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
                <path d="M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h2 class="welcome-title">{{ __('laravel_installer.welcome') }}</h2>
        <p class="welcome-desc">
            {{ __('laravel_installer.welcome_desc') }}
        </p>
        @if (config('installer.licence.enable'))
            <a class="btn btn-primary" href="{{ route('install::licence') }}">
                {{ __('laravel_installer.start') }}
            </a>
        @else
            <a class="btn btn-primary" href="{{ route('install::permissions') }}">
                {{ __('laravel_installer.start') }}
            </a>
        @endif
    </div>
</div>
@endsection
