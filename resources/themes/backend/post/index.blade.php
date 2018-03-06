@extends('backend._layout.master')
@section('headTitle', '文章')

@section('moduleName', 'post')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-post"></i>文章列表
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/post') }}">博客管理</a></li>
            <li class="breadcrumb-item active">文章列表</li>
        </ul>
    </div>
    {{-- 文章信息表格 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <button class="btn btn-dark btn-sm js-btn-get-check">获取选中id</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover post-list">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <div class="animated-checkbox">
                                        <label class="form-check-label">
                                            <input class="post-all-check" type="checkbox">
                                            <span class="label-text"></span>
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">文章标题</th>
                                <th scope="col">所属分类</th>
                                <th scope="col">标签数目</th>
                                <th scope="col">状态</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">修改时间</th>
                                <th scope="col">发布时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($posts))
                                @foreach($posts as $post)
                                    <tr>
                                        <th scope="row">
                                            <div class="animated-checkbox">
                                                <label class="form-check-label">
                                                    <input class="post-check" type="checkbox" value="{{ $post->id }}">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ count($post->tags) }}个</td>
                                        <td>{{ $post->status == 1 ? '已发布' : '草稿' }}</td>
                                        <td title="{{ $post->created_at }}">
                                            {{ $post->created_at->format('Y-m-d') }}
                                            {{-- {{ date_format($post->created_at, 'Y-m-d') }} --}}
                                        </td>
                                        <td title="{{ $post->updated_at }}">
                                            {{ $post->updated_at->format('Y-m-d') }}
                                            {{-- {{ date_format($post->updated_at, 'Y-m-d') }} --}}
                                        </td>
                                        <td title="{{ $post->published_at }}">
                                            {{ substr($post->published_at, 0, 10) }}
                                            {{-- {{ isset($post->published_at) ? Carbon\Carbon::parse($post->published_at)->format('Y-m-d') : '' }} --}}
                                            {{-- {{ isset($post->published_at) ? date_format(Carbon\Carbon::parse($post->published), 'Y-m-d') : '' }} --}}
                                            {{-- {{ isset($post->published_at) ? date('Y-m-d', strtotime($post->published_at)) : '' }} --}}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" role="button"
                                               href="{{ route('post.show', [$post->id]) }}">
                                                <i class="fi fi-details"></i>详情
                                            </a>
                                            <a class="btn btn-sm btn-outline-info" role="button"
                                               href="{{ route('post.edit', [$post->id]) }}">
                                                <i class="fi fi-edit"></i>编辑
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger js-btn-delete" role="button"
                                               href="javascript:" data-m-id="{{ $post->id }}" >
                                                <i class="fi fi-delete"></i>删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        暂无文章记录
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('bodyAssets')
    {{-- 这里的内容会填充在 body 底部上面 --}}
@stop
