<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Post;

/**
 * 前端首页控制器
 * Class IndexController
 * @package App\Http\Controllers\Frontend
 */
class IndexController extends FrontendController
{
    /**
     * 首页页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('status',1)->orderBy('published_at', 'desc')->paginate(5);

        return view('frontend.index.index', compact('posts'));
    }
}
