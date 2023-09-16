@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.environment.title'))

@section('content')    
    <form method="post" action="{{route('install::environment')}}">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
        @endif
        @csrf
        @method('POST')
        <div class="mt-4 mb-4">
            <textarea class="form-control" name="content" >{{$file}}</textarea>
        </div>
        <div class="d-flex justify-content-center">

            <button type="submit" class="btn btn-primary">{{__('laravel_installer.environment.save')}}</button>
        </div>
    </form>

@endsection