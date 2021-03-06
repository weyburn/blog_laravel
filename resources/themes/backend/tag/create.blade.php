@extends('backend._layout.master')
@section('headTitle', '标签')

@section('moduleName', 'tag')
@section('pageName', 'create')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-tag"></i>新增标签
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/tag') }}">标签管理</a></li>
            <li class="breadcrumb-item active">新增标签</li>
        </ul>
    </div>
    {{-- 新增标签表单 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <form class="form-row tag-form" onsubmit="return false" data-parsley-validate>
                        <div class="col-md-6">
                            <div class="form-group parsley-form-group">
                                <label class="col-form-label" for="tagNameInput">标签名称</label>
                                <input class="form-control" id="tagNameInput" type="text" name="name"
                                       placeholder="请输入标签名称" aria-describedby="tagHelp"
                                       data-parsley-trigger="blur"
                                       data-parsley-required="true" data-parsley-required-message="标签名称为必填项"
                                       data-parsley-maxlength="36" data-parsley-maxlength-message="标签名称不得超过36个字符">
                                <small class="form-text text-muted" id="tagHelp">标签名称请控制在36个字符以内。</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="panel-footer">
                                <button class="btn btn-sm btn-primary js-btn-submit" type="submit">新增标签</button>
                                <button class="btn btn-sm btn-secondary" type="reset">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('bodyAssets')
    {{-- 这里的内容会填充在 body 底部上面 --}}
@stop
