@extends('vendor.ajamaa.laravel-installer.layouts.app')

@section('title', __('laravel_installer.licence.title'))

@section('content')    
    <form method="post" action="{{route('install::licence')}}">
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
            <label for="exampleInputEmail1" class="form-label">
                {{__('laravel_installer.licence.form.label')}}
            </label>
            <input type="text" placeholder="ABCD-EFGH-IJKL-MNOP" class="form-control" name="key" />
        </div>
        <div class="d-flex justify-content-center">

            <button type="submit" class="btn btn-primary">{{__('laravel_installer.licence.next')}}</button>
        </div>
    </form>
@endsection