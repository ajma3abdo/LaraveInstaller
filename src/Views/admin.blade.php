@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.admin.title'))

@section('content')    
    <form method="post" action="{{route('install::admin')}}">
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
        
        @foreach (config('installer.admin.form') as $name => $item)
            <div class="mb-3">
                <label for="{{$name}}" class="form-label" style="text-transform: capitalize">
                    {{__("laravel_installer.admin.form.$name")}}
                </label>
                <input type="{{$item['type']}}" class="form-control" id="{{$name}}" name="{{$name}}"/>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{__('laravel_installer.admin.save')}}</button>
        </div>
    </form>

@endsection