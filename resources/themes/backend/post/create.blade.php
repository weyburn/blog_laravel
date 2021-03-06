@extends('backend._layout.master')
@section('headTitle', '文章')

@section('moduleName', 'post')
@section('pageName', 'create')

@section('headAssets')
    {{-- 这里的内容会填充在 head 里 --}}
    <style>
    </style>
@stop

@section('main')
    {{-- 面包屑导航 --}}
    <div class="app-title">
        <h1>
            <i class="fi fi-post"></i>新增文章
        </h1>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/') }}"><i class="fi fi-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/post') }}">博客管理</a></li>
            <li class="breadcrumb-item active">新增文章</li>
        </ul>
    </div>
    {{-- 新建文章表单 --}}
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <form class="form-row post-form" onsubmit="return false" data-parsley-validate>
                        <div class="col-md-6">
                            <div class="form-group parsley-form-group">
                                <label class="col-form-label" for="postTitleInput">文章标题</label>
                                <input class="form-control" id="postTitleInput" type="text" name="title"
                                       placeholder="请输入文章标题" aria-describedby="postTitleHelp"
                                       data-parsley-trigger="blur"
                                       data-parsley-required="true" data-parsley-required-message="文章标题为必填项"
                                       data-parsley-maxlength="255" data-parsley-maxlength-message="文章标题不得超过255个字符">
                                <small class="form-text text-muted" id="postTileHelp">文章标题请控制在255个字符以内。</small>
                            </div>
                            <div class="form-group parsley-form-group">
                                <label class="col-form-label" for="postStatusSelect">状态</label>
                                <select class="form-control" id="postStatusSelect" name="status">
                                    <option value="0">草稿</option>
                                    <option value="1">发布</option>
                                </select>
                            </div>
                            <div class="form-group parsley-form-group">
                                <label class="col-form-label" for="postCategorySelect">分类</label>
                                <select class="form-control" id="postCategorySelect" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">标签</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @if(count($tags))
                                        @foreach($tags as $tag)
                                            <label class="btn btn-sm btn-outline-secondary">
                                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"><i class="fi fi-tag"></i>{{ $tag->name }}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <small class="form-text text-muted">标签为非必填项，可不选。</small>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group parsley-form-group">
                                <label class="col-form-label" for="postContentInput">文章内容</label>
                                <textarea class="form-control summernote" id="postContentInput" name="content"
                                          data-parsley-required="true" data-parsley-required-message="文章内容为必填项"
                                          data-parsley-trigger="blur"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="panel-footer">
                                <button class="btn btn-primary js-btn-submit" type="submit">新增文章</button>
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
    <script>
        $('.summernote').summernote({
            height: 300,
            tabsize: 2,
            lang: 'zh-CN',
            toolbar: [
                ['style', ['style']],
                ['clear', ['clear']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                ['fontOther', ['fontname', 'fontsize', 'color']],
                ['para', ['height', 'paragraph', 'ul', 'ol']],
                ['insert', ['table', 'hr', 'link', 'picture', 'video']],
                ['view', ['codeview', 'fullscreen']],
                ['misc', ['undo', 'redo']],
            ],
            placeholder: '请输入内容'
        });
    </script>
@stop
