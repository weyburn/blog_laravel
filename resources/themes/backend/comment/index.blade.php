@extends('backend._layout.master')
@section('headTitle', '评论')

@section('moduleName', 'comment')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-comment"></i>
            评论列表
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/comment') }}">评论管理</a></li>
            <li class="breadcrumb-item active">评论列表</li>
        </ul>
    </div>
    {{-- 评论信息表格 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <button class="btn btn-dark btn-sm js-btn-get-check">获取选中id</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover comment-list">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <div class="animated-checkbox">
                                        <label class="form-check-label">
                                            <input class="comment-all-check" type="checkbox">
                                            <span class="label-text"></span>
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">评论者</th>
                                <th scope="col">所评文章</th>
                                <th scope="col">评论内容</th>
                                <th scope="col">状态</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($comments))
                                @foreach($comments as $comment)
                                    <tr>
                                        <th scope="row">
                                            <div class="animated-checkbox">
                                                <label class="form-check-label">
                                                    <input class="comment-check" type="checkbox" value="{{ $comment->id }}">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>{{ $comment->id }}</th>
                                        <td title="邮箱:{{ $comment->email }},网址:{{ $comment->website }},IP:{{ $comment->ip }}">
                                            {{ $comment->name }}
                                        </td>
                                        <td>{{ $comment->post->title }}</td>
                                        <td>
                                            @if($comment->reply_id)
                                                <span class="text-primary">
                                                    回复{{ $comment->reply_name }}
                                                </span>
                                            @endif
                                            {{ $comment->content }}
                                        </td>
                                        <td>{{ $comment->status == 1 ? '已读' : '未读' }}</td>
                                        <td title="{{ $comment->created_at}}">
                                            {{ $comment->created_at->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" role="button"
                                               href="{{ route('comment.show', [$comment->id]) }}">
                                                <i class="fi fi-details"></i>详情
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger js-btn-delete" role="button"
                                               href="javascript:" data-m-id="{{ $comment->id }}">
                                                <i class="fi fi-delete"></i>删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-center">暂无评论记录</td>
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
    {{--这里的内容会填充在 body 底部上面--}}
@stop
