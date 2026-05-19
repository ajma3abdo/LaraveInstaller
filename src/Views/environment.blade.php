@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.environment.title'))

@section('content')
<div class="install-card">
    <form method="post" action="{{ route('install::environment') }}">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @csrf
        @method('POST')

        <div class="mb-4">
            <label class="form-label">{{ __('laravel_installer.environment.label') }}</label>
            <textarea class="form-control" name="content">{{ $file }}</textarea>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn-back" href="{{ route('install::requirements') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                {{ __('laravel_installer.back') }}
            </a>
            <button type="submit" class="btn btn-primary">
                {{ __('laravel_installer.environment.save') }}
            </button>
        </div>
    </form>
</div>
@endsection
