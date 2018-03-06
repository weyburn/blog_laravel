<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Validator;

/**
 * 分类控制器
 * Class CategoryController
 * @package App\Http\Controllers\Backend
 */
class CategoryController extends BackendController
{
    // HTTP请求      路径                         动作        路由的名字
    // GET          /resource                    index      resource.index
    // GET	        /resource/{resource}	     show	    resource.show
    // GET          /resource/create             create     resource.create
    // POST         /resource	                 store	    resource.store
    // GET	        /resource/{resource}/edit    edit	    resource.edit
    // PUT/PATCH    /resource/{resource}	     update	    resource.update
    // DELETE	    /resource/{resource}	     destroy    resource.destroy


    /**
     * 分类列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();

        return view('backend.category.index', compact('categories'));
    }


    /**
     * 分类详情视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            die('分类不存在');
        }

        $prev_category_id = Category::where('id', '<', $id)->max('id');
        $next_category_id = Category::where('id', '>', $id)->min('id');

        return view('backend.category.show', compact('category','prev_category_id','next_category_id'));
    }


    /**
     * 新增分类视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.category.create');
    }


    /**
     * 新增分类
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 获取请求数据
        $data = $request->only('name');

        // 校验规则
        $rule = [
            'name' => 'bail|required|alpha_dash|max:36'
        ];

        // 错误信息
        $messages = [
            'name.required' => '分类名称为必填项',
            'name.alpha_dash' => '分类名称仅允许字母、数字、破折号（-）以及下划线（_）',
            'name.max' => '分类名称不得超过36个字符'
        ];

        // 校验数据
        $validator = Validator::make($data, $rule, $messages);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        // 校验成功
        if (Category::create($data)) {
            // 新增分类成功
            return response()->json([
                'status' => 200,
                'message' => '新增成功'
            ]);
        } else {
            // 新增分类失败
            return response()->json([
                'status' => 400,
                'message' => '新增失败'
            ]);
        }
    }


    /**
     * 编辑分类视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            die('分类不存在');
        }

        return view('backend.category.edit', compact('category'));
    }


    /**
     * 更新分类
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // 获取请求数据
        $data = $request->only('name');

        // 校验规则
        $rule = [
            'name' => 'bail|required|alpha_dash|max:36'
        ];

        // 错误信息
        $messages = [
            'name.required' => '分类名称为必填项',
            'name.alpha_dash' => '分类名称仅允许字母、数字、破折号（-）以及下划线（_）',
            'name.max' => '分类名称不得超过36个字符'
        ];

        // 校验数据
        $validator = Validator::make($data, $rule, $messages);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        // 校验成功
        $category = Category::find($id);
        $category->name = $data['name'];

        if ($category->save()) {
            // 更新分类成功
            return response()->json([
                'status' => 200,
                'message' => '修改成功'
            ]);
        } else {
            // 更新分类失败
            return response()->json([
                'status' => 400,
                'message' => '修改失败'
            ]);
        }
    }


    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (count($category->posts)) {
            return response()->json([
                'status' => 400,
                'message' => '存在文章，不能删除'
            ]);
        }

        if ($category->delete()) {
            return response()->json([
                'status' => 200,
                'message' => '删除成功'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => '删除失败'
            ]);
        }
    }
}
