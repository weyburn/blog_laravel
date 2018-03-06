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
    @section('headKeywords')
        <meta name="keywords" content="Weyburn, Weyburn's Blog">
    @show
    @section('headDescription')
        <meta name="description" content="个人博客, 技术博客, 前端学习总结">
    @show
    <meta name="apple-mobile-web-app-title" content="Weyburn">
    <meta name="application-name" content="Weyburn's Blog">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/head-pic.jpg') }}">

    <title>
        @yield('headTitle')
        {{ Request::segment(1) ? ' - ' : null }}
        Weyburn's Blog
    </title>

    @if(isset($_gStaticFiles['styles']))
        @foreach($_gStaticFiles['styles'] as $style)
            <link rel="stylesheet" href="{!! $style !!}">
        @endforeach
    @endif
    <link href="https://cdn.bootcss.com/pace/1.0.2/themes/black/pace-theme-minimal.css" rel="stylesheet">
    @yield('headAssets')
</head>
<body class="page page--@yield('moduleName') page--@yield('moduleName')-@yield('pageName') @yield('bodyClassExt')"
      id="page--@yield('moduleName')-@yield('pageName')"
      data-module-name="@yield('moduleName')"
      data-page-name="@yield('pageName')"
      data-base-url="@section('baseUrl') {{ url('/') }}@show"
      data-current-url="{{ URL::full() }}">
<div id="wrapper">
    <div id="header">
        @section('layoutHeader')
            <div id="topbar">
                <div class="title">
                    <h1><a href="{{ url('/') }}">Weyburn's Blog</a></h1>
                    <p>Quick Notes</p>
                    <button class="nav-toggle" type="button">
                        <i class="nav-toggle-icon"></i>
                    </button>
                </div>
                <div class="nav">
                    <a class="nav-item {{ Request::segment(1) == '' ? 'active' : '' }}"
                       href="{{ url('/') }}">
                        <i class="fi fi-home-b"></i>
                        <span>首页</span>
                    </a>
                    <a class="nav-item {{ Request::segment(1) == 'archive' ? 'active' : '' }}"
                       href="{{ url('/archive')  }}">
                        <i class="fi fi-archive-b"></i>
                        <span>归档</span>
                    </a>
                    <a class="nav-item {{ Request::segment(1) == 'category' ? 'active' : '' }}"
                       href="{{ url('/category')  }}">
                        <i class="fi fi-category-b"></i>
                        <span>分类</span>
                    </a>
                    <a class="nav-item {{ Request::segment(1) == 'tag' ? 'active' : '' }}"
                       href="{{ url('/tag')  }}">
                        <i class="fi fi-tags-b"></i>
                        <span>标签</span>
                    </a>
                    <a class="nav-item {{ Request::segment(1) == 'about' ? 'active' : '' }}"
                       href="{{ url('/about')  }}">
                        <i class="fi fi-user-b"></i>
                        <span>关于</span>
                    </a>
                </div>
            </div>
            <div id="overview">
                <div class="profile">
                    <a class="profile-avatar" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/head-pic.jpg') }}" alt="head-pic">
                    </a>
                    <h2 class="profile-name">Weyburn</h2>
                    <p class="profile-motto">Less is more.</p>
                </div>
                <div class="sub_nav">
                    <ul class="sub_nav-menu">
                        <li class="sub_nav-item">
                            <a class="sub_nav-link" href="{{ url('/archive')  }}">
                                <span class="count">{{ $count['postCount'] }}</span><br>
                                <span>日志</span>
                            </a>
                        </li>
                        <li class="sub_nav-item">
                            <a class="sub_nav-link" href="{{ url('/category')  }}">
                                <span class="count">{{ $count['categoryCount'] }}</span><br>
                                <span>分类</span>
                            </a>
                        </li>
                        <li class="sub_nav-item">
                            <a class="sub_nav-link" href="{{ url('/tag')  }}">
                                <span class="count">{{ $count['tagCount'] }}</span><br>
                                <span>标签</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="social">
                    <a class="social-item" href="https://github.com/weyburn" title="GitHub">
                        <i class="fi fi-github"></i>
                        <span>GitHub</span>
                    </a>
                    <a class="social-item"  href="https://coding.net/u/weyburn" title="Coding">
                        <i class="fi fi-coding"></i>
                        <span>Coding</span>
                    </a>
                    <a class="social-item"  href="https://weibo.com/u/3972842697" title="weibo">
                        <i class="fi fi-weibo"></i>
                        <span>weibo</span>
                    </a>
                    <a class="social-item"  href="mailto:weyburn@126.com" title="email">
                        <i class="fi fi-email"></i>
                        <span>email</span>
                    </a>
                </div>
            </div>
        @show
    </div>
    <div id="main">
        @section('layoutMain')
            <div class="main-inner">
                @yield('mainInner')
            </div>
        @show
    </div>
    <div id="footer">
        @section('layoutFooter')
            <div class="copyright">&copy; 2018 Weyburn</div>
        @show
    </div>
</div>

<div id="back-to-top">
    <i class="fi fi-arrow-up"></i>
    <span class="percent"></span>
</div>

@if(isset($_gStaticFiles['scripts']))
    @foreach($_gStaticFiles['scripts'] as $script)
        <script src="{!! $script !!}"></script>
    @endforeach
@endif
<script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
@yield('bodyAssets')
</body>
</html>
