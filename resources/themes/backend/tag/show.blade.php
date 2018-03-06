@extends('backend._layout.master')
@section('headTitle', '标签')

@section('moduleName', 'tag')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-tag"></i>标签详情
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/tag') }}">标签管理</a></li>
            <li class="breadcrumb-item active">标签详情</li>
        </ul>
    </div>
    {{-- 标签详情列表 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <th scope="row" width="25%">分类ID</th>
                                <td>{{ $tag->id }}</td>
                            </tr>
                            <tr>
                                <th>标签名称</th>
                                <td>{{ $tag->name }}</td>
                            </tr>
                            <tr>
                                <th>文章数目</th>
                                <td>{{ count($tag->posts) }}篇</td>
                            </tr>
                            <tr>
                                <th>所属文章</th>
                                <td>
                                    @if(count($tag->posts))
                                        @foreach($tag->posts as $post)
                                            <a href="{{ route('post.show', [$post->id]) }}">
                                                <i class="fi fi-post"></i>{{ $post->title }}
                                            </a>
                                            <br>
                                        @endforeach
                                    @else
                                        <span>此标签暂无文章</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{ $tag->created_at }}</td>
                            </tr>
                            <tr>
                                <th>修改时间</th>
                                <td>{{ $tag->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <ul class="pagination justify-content-center">
                        @if($prev_tag_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('tag.show', [$prev_tag_id]) }}">
                                    <i class="fi fi-previous"></i>上一页
                                </a>
                            </li>
                        @endif
                        @if($next_tag_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('tag.show', [$next_tag_id]) }}">
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

