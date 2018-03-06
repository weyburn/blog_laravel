@extends('frontend._layout.master')
@section('headTitle', '分类')

@section('moduleName', 'category')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="category">
        <dl class="category-list">
            <dt>
                <h2 class="category-name">{{ $category->name }}<small>分类</small></h2>
            </dt>
            @if(count($category->publishedPosts))
                @foreach($category->publishedPosts as $post)
                    <dd>
                        <span class="date" title="{{ substr($post->published_at, 0, 10) }}">{{ substr($post->published_at, 5, 5) }}</span>
                        <a class="link" href="{{ route('frontend.post.show',[$post->title]) }}">{{ $post->title }}</a>
                    </dd>
                @endforeach
            @endif
        </dl>
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
