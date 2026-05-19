@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.database.title'))

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="install-card">
    <div class="db-card-body">
        <div class="db-icon">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                stroke="#6366f1" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
            </svg>
        </div>

        @if (session()->has('success'))
            <p class="mb-1" style="font-weight: 700; color: var(--success); font-size: 1rem;">
                {{ session('success') }}
            </p>
            <p class="mb-4" style="color: var(--text-secondary); font-size: 0.85rem;">
                {{ __('laravel_installer.database.success_body') }}
            </p>
        @else
            <p class="mb-4" style="color: var(--text-secondary);">{{ __('laravel_installer.database.loading') }}</p>
        @endif

        @if (config('installer.admin.enable'))
            <a href="{{ route('install::admin') }}" class="btn btn-primary">
                {{ __('laravel_installer.database.next') }}
            </a>
        @else
            <a href="{{ route('install::final') }}" class="btn btn-primary">
                {{ __('laravel_installer.database.next') }}
            </a>
        @endif
    </div>
</div>
@endsection
