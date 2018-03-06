<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;

/**
 * 后台首页控制器
 * Class IndexController
 * @package App\Http\Controllers\Backend
 */
class IndexController extends BackendController
{
    /**
     * 后台首页视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.index.index');
    }
}
