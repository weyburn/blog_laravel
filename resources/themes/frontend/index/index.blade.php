@extends('frontend._layout.master')

@section('moduleName', 'index')
@section('pageName', 'index')
@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@stop

@section('mainInner')
    @if(count($posts))
        <section class="posts">
            @foreach($posts as $key => $post)
                <article class="post">
                    <div class="post-header">
                        <h1 class="title"><a class="link" href="{{ route('frontend.post.show',[$post->title])}}">{{ $post->title }}</a></h1>
                        <div class="meta">
                            <span class="meta-item">
                                <i class="fi fi-calendar"></i>
                                <span class="meta-item-explain">发表于</span>
                                <span class="date">{{ substr($post->published_at, 0, 10) }}</span>
                            </span>
                            <span class="meta-item">
                                <i class="fi fi-category"></i>
                                <span class="meta-item-explain">分类于</span>
                                <a class="category" href="{{ route('frontend.category.show',[$post->category->name]) }}">{{ $post->category->name }}</a>
                            </span>
                            <span class="meta-item comment">
                                <i class="fi fi-comment"></i>
                                <a class="comment-count" href="{{ route('frontend.post.show',[$post->title])}}#comments">{{ count($post->comments) }} Comments</a>
                            </span>
                            <span class="meta-item">
                                <i class="fi fi-view"></i>
                                <span class="meta-item-explain">阅读次数</span>
                                <span class="view-count">{{ $post->view_count }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="post-body">
                        {!!  explode('<!--more-->',$post->content)[0] !!}
                        <p class="more"><a class="link" href="{{ route('frontend.post.show',[$post->title]) }}">阅读全文 &raquo; </a></p>
                    </div>
                    @if($key+1 < $posts->count())
                        <div class="post-footer"></div>
                    @endif
                </article>
            @endforeach
        </section>
        {{ $posts->links('frontend.pagination.pagination') }}
    @endif
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
