@extends('frontend._layout.master')
@section('headTitle', '标签')

@section('moduleName', 'tag')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="tag">
        <dl class="tag-list">
            <dt>
                <h2 class="tag-name">{{ $tag->name }}<small>标签</small></h2>
            </dt>
            @if(count($tag->publishedPosts))
                @foreach($tag->publishedPosts as $post)
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
