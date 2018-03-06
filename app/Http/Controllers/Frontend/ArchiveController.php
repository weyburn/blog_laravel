<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Post;

/**
 * 归档控制器
 * Class ArchiveController
 * @package App\Http\Controllers\Frontend
 */
class ArchiveController extends FrontendController
{
    /**
     * 归档页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('status',1)->orderBy('published_at', 'desc')->pluck('title','published_at');

        return view('frontend.archive.index', compact('posts'));
    }
}
