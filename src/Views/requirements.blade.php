@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.requirements.title'))

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="install-card">
    <ul class="check-list">
        <li class="check-item {{ $phpStatus['supported'] ? 'check-success' : 'check-danger' }}">
            <span class="check-item-name">{{ __('laravel_installer.requirements.php_version') }}</span>
            <div class="check-item-right">
                <span class="check-item-badge">{{ $phpStatus['full'] }}</span>
                <div class="check-item-status">
                    <span class="status-dot"></span>
                    {{ $phpStatus['supported'] ? __('laravel_installer.requirements.supported') : __('laravel_installer.requirements.not_supported') }}
                </div>
            </div>
        </li>

        @foreach ($requirements as $requirement)
            @foreach ($requirement as $name => $check)
                <li class="check-item {{ $check ? 'check-success' : 'check-danger' }}">
                    <span class="check-item-name">{{ $name }}</span>
                    <div class="check-item-status">
                        <span class="status-dot"></span>
                        {{ $check ? __('laravel_installer.requirements.enabled') : __('laravel_installer.requirements.not_enabled') }}
                    </div>
                </li>
            @endforeach
        @endforeach
    </ul>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a class="btn-back" href="{{ route('install::permissions') }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            {{ __('laravel_installer.back') }}
        </a>

        @if (!$error)
            <a class="btn btn-primary" href="{{ route('install::environment') }}">
                {{ __('laravel_installer.requirements.next') }}
            </a>
        @else
            <span style="color: var(--danger); font-size: 0.875rem;">{{ __('laravel_installer.requirements.error') }}</span>
        @endif
    </div>
</div>
@endsection
