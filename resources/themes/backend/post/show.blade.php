@extends('backend._layout.master')
@section('headTitle', '文章')

@section('moduleName', 'post')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-post"></i>文章详情
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/post') }}">文章管理</a></li>
            <li class="breadcrumb-item active">文章详情</li>
        </ul>
    </div>
    {{-- 文章详情列表 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <th scope="row" width="25%">文章ID</th>
                                <td>{{ $post->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">文章标题</th>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <th scope="row">所属分类</th>
                                <td>
                                    <a href="{{ route('category.show', [$post->category->id]) }}">
                                        <i class="fi fi-category"></i>{{ $post->category->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">标签数目</th>
                                <td>{{ count($post->tags) }}个</td>
                            </tr>
                            <tr>
                                <th scope="row">所属标签</th>
                                <td>
                                    @if(count($post->tags))
                                        @foreach($post->tags as $tag)
                                            <a class="mr-3" href="{{ route('tag.show', [$tag->id]) }}">
                                                <i class="fi fi-tag"></i>{{ $tag->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <span>此文章暂无标签</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row">文章内容</th>
                                <td>
                                    {!! $post->content !!}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">阅读次数</th>
                                <td>{{ $post->view_count }}次</td>
                            </tr>
                            <tr>
                                <th scope="row">评论数目</th>
                                <td>{{ count($post->comments) }}条</td>
                            </tr>
                            <tr>
                                <th scope="row">所属评论</th>
                                <td>
                                    @if(count($post->comments))
                                        @foreach($post->comments as $comment)
                                            <p title="{{ $comment->created_at }}">
                                                <b>{{ $comment->name }}：</b>
                                                @if($comment->reply_id)
                                                    <span class="text-primary">回复{{ $comment->reply_name }}</span>
                                                @endif
                                                <span>{{ $comment->content }}</span>
                                            </p>
                                        @endforeach
                                    @else
                                        此文章暂无评论
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">状态</th>
                                <td>{{ $post->status == 1 ? '已发布' : '草稿' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">创建时间</th>
                                <td>{{ $post->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">修改时间</th>
                                <td>{{ $post->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">发布时间</th>
                                <td>{{ $post->published_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <ul class="pagination justify-content-center">
                        @if($prev_post_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('post.show', [$prev_post_id]) }}">
                                    <i class="fi fi-previous"></i>上一页
                                </a>
                            </li>
                        @endif
                        @if($next_post_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('post.show', [$next_post_id]) }}">
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

