@extends('frontend._layout.master')
@section('headTitle', '文章')

@section('moduleName', 'post')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@stop

@section('mainInner')
    <section class="posts">
        <article class="post">
            <div class="post-header">
                <h1 class="title">{{ $post->title }}</h1>
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
                        <a class="comment-count" href="#comments">{{ count($post->comments) }} Comments</a>
                    </span>
                    <span class="meta-item">
                        <i class="fi fi-view"></i>
                        <span class="meta-item-explain">阅读次数</span>
                        <span class="view-count">{{ $post->view_count }}</span>
                    </span>
                </div>
            </div>
            <div class="post-body">
                {!! $post->content !!}
            </div>
            <div class="post-footer">
                @if(count($post->tags))
                    <div class="post-tag">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('frontend.tag.show',[$tag->name]) }}">
                                <i class="fi fi-tag"></i>{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="post-nav">
                    @if(isset($prev_post))
                        <a class="post-nav-item post-nav-prev" href="{{ route('frontend.post.show',[$prev_post->title]) }}">
                            <i class="fi fi-previous"></i>{{ $prev_post->title }}
                        </a>
                    @else
                        <a class="post-nav-item post-nav-prev"></a>
                    @endif
                    @if(isset($next_post))
                        <a class="post-nav-item post-nav-next" href="{{ route('frontend.post.show',[$next_post->title]) }}">
                            {{ $next_post->title }}<i class="fi fi-next"></i>
                        </a>
                    @else
                        <a class="post-nav-item post-nav-next"></a>
                    @endif
                </div>
            </div>
        </article>
        @include('frontend.comment.comment')
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
