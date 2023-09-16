@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.permissions.title'))

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif

<ul class="list">
    @foreach ($permissions as $permission)
        <li class="list-group-item list-group-item-{{$permission['isSet'] ? 'success' : 'danger'}} d-flex justify-content-between p-4 mb-2">
            <span>
                {{ $permission['folder'] }}
            </span>
            <span>
                {{ $permission['permission'] }}
            </span>
        </li>

    @endforeach
</ul>

@if (!$error)
    <div class="d-flex justify-content-center w-full mt-4">
        <a class="btn btn-primary" href="{{route('install::requirements')}}">
            {{__('laravel_installer.permissions.next')}}
        </a>
    </div>
@else
<div class="d-flex justify-content-center w-full p-4">
    {{__('laravel_installer.permissions.error')}}
</div>
@endif
@endsection