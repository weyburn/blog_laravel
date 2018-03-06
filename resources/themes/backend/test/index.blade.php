<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="chrome=1, IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">

    <link rel="shortcut icon" href="{{ asset('assets/images/head-pic.jpg') }}">

    <title>Test</title>

    {{-- 导入打包后的CSS --}}
    @if(isset($_gStaticFiles['styles']))
        @foreach($_gStaticFiles['styles'] as $styleSrc)
            <link rel="stylesheet" href="{{ asset($styleSrc) }}">
        @endforeach
    @endif
    <link href="https://cdn.bootcss.com/pace/1.0.2/themes/black/pace-theme-minimal.css" rel="stylesheet">
</head>

{{-- 这里给 document.body 加个命名空间 --}}
<body class="app body-test-index">
<header class="app-header">
    <div class="app-nav justify-content-center">
        <a class="app-nav__item" href="#"><i class="fi fi-home"></i>首页</a>
        <a class="app-nav__item" href="#"><i class="fi fi-post"></i>博客</a>
        <a class="app-nav__item" href="#"><i class="fi fi-category"></i>分类</a>
        <a class="app-nav__item" href="#"><i class="fi fi-tag"></i>标签</a>
        <a class="app-nav__item" href="#"><i class="fi fi-comments"></i>评论</a>
    </div>
</header>

<main class="app-content main ml-0">
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <h3 class="panel-header line-head">标题</h3>
                <div class="panel-body">
                    <div class="animated-checkbox">
                        <label class="col-form-label">
                            <input type="checkbox">
                            <span class="label-text">多选框</span>
                        </label>
                    </div>
                    <div class="animated-radio">
                        <label class="col-form-label">
                            <input type="radio">
                            <span class="label-text">单选框</span>
                        </label>
                    </div>
                </div>
                <div class="panel-footer">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <form class="form-row" onsubmit="return false">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="emailInput">邮箱</label>
                                <input class="form-control" type="email" id="emailInput" aria-describedby="emailHelp"
                                       placeholder="请输入邮箱">
                                <small class="form-text text-muted" id="emailHelp">邮箱地址不会被公开</small>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="categorySelect">分类</label>
                                <select class="form-control" id="categorySelect">
                                    <option value="1">HTML</option>
                                    <option value="2">CSS</option>
                                    <option value="3">JavaScript</option>
                                    <option value="4">PHP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-form-label" for="textarea">内容</label>
                                <textarea class="form-control" id="textarea" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox">记住我
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit">提交</button>
                    <button class="btn btn-secondary" type="reset">重置</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="btn-group-toggle" data-toggle="buttons">
                    @if(count($tags))
                        @foreach($tags as $tag)
                            <label class="btn btn-sm btn-outline-primary">
                                <input type="checkbox" value="{{ $tag->id }}"><i class="fi fi-tag"></i>{{ $tag->name}}
                            </label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

{{--导入打包后的JS--}}
@if(isset($_gStaticFiles['scripts']))
    @foreach($_gStaticFiles['scripts'] as $scriptSrc)
        <script src="{{ asset($scriptSrc) }}"></script>
    @endforeach
@endif
<script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
</body>
</html>
