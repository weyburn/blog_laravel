<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Tag;

/**
 * 标签控制器
 * Class TagController
 * @package App\Http\Controllers\Frontend
 */
class TagController extends FrontendController
{
    /**
     * 标签页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('frontend.tag.index', compact('tags'));
    }


    /**
     * 标签展示页面视图
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($name)
    {
        $tag = Tag::where('name', $name)->first();

        if (empty($tag)) {
            die('标签不存在');
        }

        return view('frontend.tag.show', compact('tag'));
    }
}
