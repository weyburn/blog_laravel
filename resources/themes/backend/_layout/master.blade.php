<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="chrome=1, IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="keywords" content="Weyburn, Weyburn's Blog">
    <meta name="description" content="个人博客, 技术博客, 前端学习总结">
    <meta name="apple-mobile-web-app-title" content="Weyburn">
    <meta name="application-name" content="Weyburn's Blog">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/head-pic.jpg') }}">

    <title>
        @yield('headTitle')
        {{ Request::segment(1) ? '- Weyburn\'s Blog Backend': null }}
    </title>

    {{-- 样式 --}}
    @if(isset($_gStaticFiles['styles']))
        @foreach($_gStaticFiles['styles'] as $styleSrc)
            <link rel="stylesheet" href="{!! $styleSrc !!}">
        @endforeach
    @endif
    <link href="https://cdn.bootcss.com/pace/1.0.2/themes/black/pace-theme-minimal.css" rel="stylesheet">
    @yield('headAssets')
</head>

<body class="app sidebar-mini page page--@yield('moduleName') page--@yield('moduleName')-@yield('pageName') @yield('bodyClassExt')"
      id="page--@yield('moduleName')-@yield('pageName')"
      data-module-name="@yield('moduleName')"
      data-page-name="@yield('pageName')"
      data-base-url="@section('baseUrl') {{ url('/') }}@show"
      data-end-url="@section('endUrl') {{ url('/admin') }}@show"
      data-current-url="{{ URL::full() }}">
      data-m-id="@yield('mId')"
      data-m-name="@yield('mName')">
section('header')
    {{-- 头部 --}}
    <header class="app-header">
        {{-- logo --}}
        <a class="app-header__logo" href="{{ url('/admin') }}">Admin</a>
        {{-- toggle --}}
        <a class="app-sidebar__toggle" href="javascript:" data-toggle="sidebar">
            <i class="app-sidebar__toggle__icon fi fi-toggle"></i>
        </a>
        {{-- 导航栏 --}}
        <ul class="app-nav">
            {{-- 搜索框 --}}
            <li class="app-search">
                <input class="app-search__input" type="search" placeholder="请输入搜索内容">
                <button class="app-search__button" type="button">
                    <i class="fi fi-search"></i>
                </button>
            </li>
            {{-- 下拉框 --}}
            <li class="dropdown">
                <a class="app-nav__item" href="javascript:" data-toggle="dropdown">
                    <i class="fi fi-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a class="dropdown-item" href="{{ url('/') }}">
                            <i class="fi fi-external-link"></i>前台
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:">
                            <i class="fi fi-refresh"></i>清除缓存
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="fi fi-logout"></i>登出
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
@show

@section('sidebar')
    {{-- 侧边栏 --}}
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        {{-- 用户简介 --}}
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="{{ asset('assets/images/admin-pic.svg') }}" alt="admin-pic">
            <div>
                <span class="app-sidebar__user-name">Weyburn</span>
                <span class="app-sidebar__user-designation">Frontend Developer</span>
            </div>
        </div>
        {{-- 菜单栏 --}}
        <ul class="app-menu">
            <li class="treeview {{ Request::segment(2) == 'post' ? 'is-expanded': '' }}">
                <a class="app-menu__item" href="javascript:" data-toggle="treeview">
                    <i class="app-menu__icon fi fi-post"></i>
                    <span class="app-menu__label">博客</span>
                    <i class="treeview-indicator fi fi-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item
                        {{ Request::segment(2) == 'post' && Request::getPathInfo() != '/admin/post/create' ? 'active' : '' }}"
                           href="{{ route('post.index') }}">
                            <i class="icon fi fi-circle"></i>文章列表
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item {{ Request::getPathInfo() == '/admin/post/create' ? 'active' : '' }}"
                           href="{{ route('post.create') }}">
                            <i class="icon fi fi-circle"></i>新增文章
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == 'category' ? 'is-expanded': '' }}">
                <a class="app-menu__item" href="javascript:" data-toggle="treeview">
                    <i class="app-menu__icon fi fi-category"></i>
                    <span class="app-menu__label">分类</span>
                    <i class="treeview-indicator fi fi-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item
                        {{ Request::segment(2) == 'category' && Request::getPathInfo() != '/admin/category/create' ? 'active' : '' }}"
                           href="{{ route('category.index') }}">
                            <i class="icon fi fi-circle"></i>分类列表
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item {{ Request::getPathInfo() == '/admin/category/create' ? 'active' : '' }}"
                           href="{{ route('category.create') }}">
                            <i class="icon fi fi-circle"></i>新增分类
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == 'tag' ? 'is-expanded': '' }}">
                <a class="app-menu__item" href="javascript:" data-toggle="treeview">
                    <i class="app-menu__icon fi fi-tag"></i>
                    <span class="app-menu__label">标签</span>
                    <i class="treeview-indicator fi fi-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item
                        {{ Request::segment(2) == 'tag' && Request::getPathInfo() != '/admin/tag/create' ? 'active' : '' }}"
                           href="{{ route('tag.index') }}">
                            <i class="icon fi fi-circle"></i>标签列表
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item {{ Request::getPathInfo() == '/admin/tag/create' ? 'active' : '' }}"
                           href="{{ route('tag.create') }}">
                            <i class="icon fi fi-circle"></i>新增标签
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == 'comment' ? 'is-expanded': '' }}">
                <a class="app-menu__item" href="javascript:" data-toggle="treeview">
                    <i class="app-menu__icon fi fi-comment"></i>
                    <span class="app-menu__label">评论</span>
                    <i class="treeview-indicator fi fi-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item {{ Request::segment(2) == 'comment' ? 'active' : '' }}"
                           href="{{ route('comment.index') }}">
                            <i class="icon fi fi-circle"></i>评论列表
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
@show

<main class="app-content main">
    @yield('main')
</main>

{{-- 脚本 --}}
@if(isset($_gStaticFiles['scripts']))
    @foreach($_gStaticFiles['scripts'] as $scriptSrc)
        <script src="{!! $scriptSrc !!}"></script>
    @endforeach
@endif
<script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
@yield('bodyAssets')
</body>
</html>
