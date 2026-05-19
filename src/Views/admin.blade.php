@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.admin.title'))

@section('content')
<div class="install-card">
    <form method="post" action="{{ route('install::admin') }}">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @csrf
        @method('POST')

        @foreach (config('installer.admin.form') as $name => $item)
            <div class="mb-3">
                <label for="{{ $name }}" class="form-label">
                    {{ __("laravel_installer.admin.form.$name") }}
                </label>
                <input type="{{ $item['type'] }}"
                       class="form-control"
                       id="{{ $name }}"
                       name="{{ $name }}" />
            </div>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mt-3">
            <a class="btn-back" href="{{ route('install::environment') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                {{ __('laravel_installer.back') }}
            </a>
            <button type="submit" class="btn btn-primary">
                {{ __('laravel_installer.admin.save') }}
            </button>
        </div>
    </form>
</div>
@endsection
