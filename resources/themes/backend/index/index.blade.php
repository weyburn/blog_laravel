@extends('backend._layout.master')
@section('headTitle', '首页')

@section('moduleName', 'index')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    <div class="app-title flex-row justify-content-center">
        <h1><i class="fi fi-home"></i></h1>
    </div>
@stop

@section('bodyAssets')
    {{-- 这里的内容会填充在 body 底部上面 --}}
@stop
