@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.licence.title'))

@section('content')
<div class="install-card">
    <form method="post" action="{{ route('install::licence') }}">
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @csrf
        @method('POST')

        <div class="mb-4">
            <label class="form-label">{{ __('laravel_installer.licence.form.label') }}</label>
            <input type="text"
                   placeholder="ABCD-EFGH-IJKL-MNOP"
                   class="form-control"
                   name="key"
                   autocomplete="off"
                   style="letter-spacing: 0.08em; font-family: monospace; font-size: 1rem !important;" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn-back" href="{{ route('install::index') }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                رجوع
            </a>
            <button type="submit" class="btn btn-primary">
                {{ __('laravel_installer.licence.next') }}
            </button>
        </div>
    </form>
</div>
@endsection
