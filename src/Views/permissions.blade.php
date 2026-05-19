@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.permissions.title'))

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="install-card">
    <ul class="check-list">
        @foreach ($permissions as $permission)
            <li class="check-item {{ $permission['isSet'] ? 'check-success' : 'check-danger' }}">
                <span class="check-item-name">{{ $permission['folder'] }}</span>
                <div class="check-item-right">
                    @if (!$permission['isSet'])
                        <span class="check-item-badge" title="{{ __('laravel_installer.permissions.current') }}">
                            {{ $permission['current_permission'] }}
                        </span>
                        <span style="color:var(--text-muted);font-size:0.75rem;">→</span>
                    @endif
                    <span class="check-item-badge" title="{{ __('laravel_installer.permissions.required') }}">
                        {{ $permission['permission'] }}
                    </span>
                    <div class="check-item-status">
                        <span class="status-dot"></span>
                        {{ $permission['isSet'] ? __('laravel_installer.permissions.enabled') : __('laravel_installer.permissions.failed') }}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-between align-items-center mt-4">
        @if (config('installer.licence.enable'))
            <a class="btn-back" href="{{ route('install::licence') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                {{ __('laravel_installer.back') }}
            </a>
        @else
            <a class="btn-back" href="{{ route('install::index') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                {{ __('laravel_installer.back') }}
            </a>
        @endif

        @if (!$error)
            <a class="btn btn-primary" href="{{ route('install::requirements') }}">
                {{ __('laravel_installer.permissions.next') }}
            </a>
        @else
            <span style="color: var(--danger); font-size: 0.875rem;">{{ __('laravel_installer.permissions.error') }}</span>
        @endif
    </div>
</div>
@endsection
