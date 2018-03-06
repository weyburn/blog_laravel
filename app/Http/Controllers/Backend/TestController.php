<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Tag;

/**
 * 测试控制器
 * 随便写测试代码
 * Class TestController
 * @package App\Http\Controllers\Backend
 */
class TestController extends BackendController
{
    /**
     * 测试页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::all();

        return view('backend.test.index',compact('tags'));
    }
}
