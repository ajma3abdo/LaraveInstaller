@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.requirements.title'))

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif

<ul class="list">
    <li class="list-group-item list-group-item-{{$phpStatus['supported'] ? 'success' : 'danger'}} d-flex justify-content-between p-4 mb-2">
        <span>
            {{ $phpStatus['full'] }}
        </span>
        <span>
            PHP Version
        </span>
    </li>
    @foreach ($requirements as $requirement)
        @foreach ($requirement as $name => $check)
            <li class="list-group-item list-group-item-{{$check ? 'success' : 'danger'}} d-flex justify-content-end p-4 mb-2">
                <span>
                    {{ $name }}
                </span>
            </li>
        @endforeach
    @endforeach
</ul>

@if (!$error)
    <div class="d-flex justify-content-center w-full mt-4">
        <a class="btn btn-primary" href="{{route('install::environment')}}">
            {{__('laravel_installer.requirements.next')}}
        </a>
    </div>
@else
<div class="d-flex justify-content-center w-full p-4">
    {{__('laravel_installer.requirements.error')}}
</div>
@endif
@endsection