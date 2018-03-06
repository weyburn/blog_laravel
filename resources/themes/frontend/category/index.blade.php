@extends('frontend._layout.master')
@section('headTitle', '分类')

@section('moduleName', 'category')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="category">
        <div class="category-header">
            <h1 class="title">分类</h1>
            <p class="total">【目前共计 {{ count($categories) }} 个分类】</p>
        </div>
        @if (count($categories))
            <ul class="category-list">
                @foreach($categories as $category)
                    <li class="category-item">
                        <a class="link" href="{{ route('frontend.category.show',[$category->name] ) }}">{{ $category->name }}</a>
                        <span class="post-count">( {{ count($category->publishedPosts) }} )</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
