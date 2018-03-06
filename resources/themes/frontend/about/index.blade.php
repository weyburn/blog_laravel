@extends('frontend._layout.master')
@section('headTitle', '关于')

@section('moduleName', 'about')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里是头部，可以引入需要的 JS 、 CSS --}}
@stop

@section('mainInner')
    <section class="about">
        <div class="about-header">
            <h1 class="title">关于</h1>
        </div>
        <div class="about-body">
            <h2 class="sub-title">关于我</h2>
            <p>我，90后，自学前端，建立此博客目的是用于学习与交流，并督促自己对学习和工作上所遇到的问题加以总结。</p>
            <h2 class="sub-title">联系方式</h2>
            <p>
                <span>邮箱：</span>
                <a class="link" href="mailto:weyburn@126.com">weyburn@126.com</a>
            </p>
        </div>
    </section>
@stop

@section('bodyAssets')
    {{-- 这里是尾部，可以引入需要的 JS 、 CSS --}}
@stop
