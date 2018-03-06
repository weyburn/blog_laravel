@extends('backend._layout.master')
@section('headTitle', '分类')

@section('moduleName', 'category')
@section('pageName', 'show')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-category"></i>分类详情
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">分类管理</a></li>
            <li class="breadcrumb-item active">分类详情</li>
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
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr>
                                <th>分类名称</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>文章数目</th>
                                <td>{{ count($category->posts) }}篇</td>
                            </tr>
                            <tr>
                                <th>所属文章</th>
                                <td>
                                    @if(count($category->posts))
                                        @foreach($category->posts as $post)
                                            <a href="{{ route('post.show', [$post->id]) }}">
                                                <i class="fi fi-post"></i>{{ $post->title }}
                                            </a>
                                            <br>
                                        @endforeach
                                    @else
                                        <span>此分类暂无文章</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>创建时间</th>
                                <td>{{ $category->created_at }}</td>
                            </tr>
                            <tr>
                                <th>修改时间</th>
                                <td>{{ $category->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <ul class="pagination justify-content-center">
                        @if($prev_category_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('category.show', [$prev_category_id]) }}">
                                    <i class="fi fi-previous"></i>上一页
                                </a>
                            </li>
                        @endif
                        @if($next_category_id)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('category.show', [$next_category_id]) }}">
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

