@extends('backend._layout.master')
@section('headTitle', '评论')

@section('moduleName', 'comment')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-comment"></i>评论详情
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/comment') }}">评论管理</a></li>
            <li class="breadcrumb-item active">评论详情</li>
        </ul>
    </div>
    {{-- 评论详情列表 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover comment-show-list">
                            <tbody>
                            <tr>
                                <th scope="row" width="25%">评论ID</th>
                                <td>{{ $comment->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">评论者名称</th>
                                <td>{{ $comment->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">评论者邮箱</th>
                                <td>{{ $comment->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">评论者网址</th>
                                <td>{{ $comment->website }}</td>
                            </tr>
                            <tr>
                                <th scope="row">评论者ip地址</th>
                                <td>{{ $comment->ip }}</td>
                            </tr>
                            <tr>
                                <th scope="row">所评文章</th>
                                <td>
                                    <a href="{{ route('post.show', [$comment->post->id]) }}">
                                        <i class="fi fi-post"></i>{{ $comment->post->title }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">评论内容</th>
                                <td>
                                    @if($comment->reply_id)
                                        <a href="{{ route('comment.show', [$comment->reply_id]) }}">
                                            回复{{ $comment->reply_name }}
                                        </a>
                                    @endif
                                    {{ $comment->content }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">状态</th>
                                <td>
                                    @if($comment->status == 1)
                                        <span>已读</span>
                                    @else
                                        <span>未读</span>
                                        <a class="btn btn-sm btn-outline-secondary js-btn-update" href="javascript:"
                                           data-m-id="{{ $comment->id }}">
                                        标记为已读</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">创建时间</th>
                                <td>{{ $comment->created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <ul class="pagination justify-content-center">
                        @if($prev_comment_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('comment.show', [$prev_comment_id]) }}">
                                    <i class="fi fi-previous"></i>上一页
                                </a>
                            </li>
                        @endif
                        @if($next_comment_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('comment.show', [$next_comment_id]) }}">
                                    下一页 <i class="fi fi-next"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('bodyAssets')
    {{--这里的内容会填充在 body 底部上面--}}
@stop
