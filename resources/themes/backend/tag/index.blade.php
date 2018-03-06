@extends('backend._layout.master')
@section('headTitle', '标签')

@section('moduleName', 'tag')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-tag"></i>标签列表
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/tag') }}">标签管理</a></li>
            <li class="breadcrumb-item active">标签列表</li>
        </ul>
    </div>
    {{-- 标签信息表格 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <button class="btn btn-dark btn-sm js-btn-get-check">获取选中id</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover tag-list">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <div class="animated-checkbox">
                                        <label class="form-check-label">
                                            <input class="tag-all-check" type="checkbox">
                                            <span class="label-text"></span>
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">标签名称</th>
                                <th scope="col">文章数目</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">修改时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($tags))
                                @foreach($tags as $tag)
                                    <tr>
                                        <th scope="row">
                                            <div class="animated-checkbox">
                                                <label class="form-check-label">
                                                    <input class="tag-check" type="checkbox" value="{{ $tag->id }}">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>{{ $tag->id }}</th>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ count($tag->posts) }}篇</td>
                                        <td title="{{ $tag->created_at}}">
                                            {{ $tag->created_at->format('Y-m-d') }}
                                        </td>
                                        <td title="{{ $tag->updated_at }}">
                                            {{ $tag->updated_at->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" role="button"
                                               href="{{ route('tag.show', [$tag->id]) }}">
                                                <i class="fi fi-details"></i>详情
                                            </a>
                                            <a class="btn btn-sm btn-outline-info" role="button"
                                               href="{{ route('tag.edit', [$tag->id]) }}">
                                                <i class="fi fi-edit"></i>编辑
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger js-btn-delete" role="button"
                                               href="javascript:" data-m-id="{{ $tag->id }}"
                                               data-post-count="{{ count($tag->posts) }}">
                                                <i class="fi fi-delete"></i>删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-center">暂无标签记录</td>
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
