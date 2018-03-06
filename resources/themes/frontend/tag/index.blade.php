@extends('frontend._layout.master')
@section('headTitle', '标签')

@section('moduleName', 'tag')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="tag">
        <div class="tag-header">
            <h1 class="title">标签</h1>
            <p class="total">【目前共计 {{ count($tags) }} 个标签】</p>
        </div>
        @if(count($tags))
            <div class="tag-group">
                @foreach($tags as $tag)
                    <a class="link" href="{{ route('frontend.tag.show',[$tag->name] ) }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
