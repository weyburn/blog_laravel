<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Post;

/**
 * 文章控制器
 * Class postController
 * @package App\Http\Controllers\Frontend
 */
class postController extends FrontendController
{
    /**
     * 文章展示页面视图
     * @param $title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($title)
    {
        $post = Post::where([
            ['status', 1],
            ['title', $title]
        ])->first();

        if (empty($post)) {
            die('文章不存在');
        }

        $post->increment('view_count', 1);

        $prev_post = Post::where([
            ['status', 1],
            ['published_at', '<', $post->published_at]
        ])->orderBy('published_at', 'desc')->first();

        $next_post = Post::where([
            ['status', 1],
            ['published_at', '>', $post->published_at]
        ])->orderBy('published_at', 'asc')->first();

        return view('frontend.post.show', compact('post', 'prev_post', 'next_post'));
    }
}
