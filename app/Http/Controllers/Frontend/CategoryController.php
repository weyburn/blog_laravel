<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\FrontendController;

/**
 * 分类控制器
 * Class CategoryController
 * @package App\Http\Controllers\Frontend
 */
class CategoryController extends FrontendController
{
    /**
     * 分类页面视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('frontend.category.index', compact('categories'));
    }


    /**
     * 分类展示页面视图
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($name)
    {
        $category = Category::where('name', $name)->first();

        if (empty($category)) {
            die('分类不存在');
        }

        return view('frontend.category.show', compact('category'));
    }
}
