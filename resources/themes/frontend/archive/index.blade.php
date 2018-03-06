@extends('frontend._layout.master')
@section('headTitle', '归档')

@section('moduleName', 'archive')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="archive">
        <div class="archive-header">
            <h1 class="title">归档</h1>
            <p class="total">【目前共计 {{ count($posts) }} 篇日志】</p>
        </div>
        <dl class="archive-list">
            @foreach($posts as $time => $title)
                @if($time >= '2018-01-01' && $time <= '2018-12-31')
                    <dt>
                        <h2 class="year">2018</h2>
                    </dt>
                    @break
                @endif
            @endforeach
            @foreach($posts as $time => $title)
                @if($time >= '2018-01-01' && $time <= '2018-12-31')
                    <dd>
                        <span class="date" title="{{ substr($time, 0, 10) }}">{{ substr($time, 5, 5) }}</span>
                        <a class="link" href="{{ route('frontend.post.show',[ $title ]) }}">{{ $title }}</a>
                    </dd>
                 @endif
            @endforeach

            @foreach($posts as $time => $title)
                @if($time >= '2017-01-01' && $time <= '2017-12-31')
                    <dt>
                        <h2 class="year">2017</h2>
                    </dt>
                    @break
                @endif
            @endforeach
            @foreach($posts as $time => $title)
                @if($time >= '2017-01-01' && $time <= '2017-12-31')
                    <dd>
                        <span class="date" title="{{ substr($time, 0, 10) }}">{{ substr($time, 5, 5) }}</span>
                        <a class="link" href="{{ route('frontend.post.show',[ $title ]) }}">{{ $title }}</a>
                    </dd>
                @endif
            @endforeach

            @foreach($posts as $time => $title)
                @if($time >= '2016-01-01' && $time <= '2016-12-31')
                    <dt>
                        <h2 class="year">2016</h2>
                    </dt>
                    @break
                @endif
            @endforeach
            @foreach($posts as $time => $title)
                @if($time >= '2016-01-01' && $time <= '2016-12-31')
                    <dd>
                        <span class="date" title="{{ substr($time, 0, 10) }}">{{ substr($time, 5, 5) }}</span>
                        <a class="link" href="{{ route('frontend.post.show',[ $title ]) }}">{{ $title }}</a>
                    </dd>
                @endif
            @endforeach
        </dl>
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
