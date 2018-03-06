<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;

/**
 * 关于控制器
 * Class AboutController
 * @package App\Http\Controllers\Frontend
 */
class AboutController extends FrontendController
{
    /**
     * 关于页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.about.index');
    }
}
