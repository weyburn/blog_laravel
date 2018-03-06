@extends('backend._layout.master')
@section('headTitle', '分类')

@section('moduleName', 'category')
@section('pageName', 'index')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-category"></i>分类列表
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">分类管理</a></li>
            <li class="breadcrumb-item active">分类列表</li>
        </ul>
    </div>
    {{-- 分类信息表格 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <button class="btn btn-dark btn-sm js-btn-get-check">获取选中id</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover category-list">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <div class="animated-checkbox">
                                        <label class="form-check-label">
                                            <input class="category-all-check" type="checkbox">
                                            <span class="label-text"></span>
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">分类名称</th>
                                <th scope="col">文章数目</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">修改时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories))
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">
                                            <div class="animated-checkbox">
                                                <label class="form-check-label">
                                                    <input class="category-check" type="checkbox" value="{{ $category->id }}">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ count($category->posts) }}篇</td>
                                        <td title="{{ $category->created_at}}">
                                            {{ $category->created_at->format('Y-m-d') }}
                                        </td>
                                        <td title="{{ $category->updated_at }}">
                                            {{ $category->updated_at->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" role="button"
                                               href="{{ route('category.show', [$category->id]) }}">
                                                <i class="fi fi-details"></i>详情
                                            </a>
                                            <a class="btn btn-sm btn-outline-info" role="button"
                                               href="{{ route('category.edit', [$category->id]) }}">
                                                <i class="fi fi-edit"></i>编辑
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger js-btn-delete" role="button"
                                               href="javascript:" data-m-id="{{ $category->id }}"
                                               data-post-count="{{ count($category->posts) }}">
                                                <i class="fi fi-delete"></i>删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-center">暂无分类记录</td>
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
