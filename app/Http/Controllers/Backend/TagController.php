<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Tag;
use Illuminate\Http\Request;
use Validator;

/**
 * 标签控制器
 * Class TagController
 * @package App\Http\Controllers\Backend
 */
class TagController extends BackendController
{
    /**
     * 标签列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::all();

        return view('backend.tag.index', compact('tags'));
    }


    /**
     * 标签详情视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        if (empty($tag)) {
            die('标签不存在');
        }

        $prev_tag_id = Tag::where('id', '<', $id)->max('id');
        $next_tag_id = Tag::where('id', '>', $id)->min('id');

        return view('backend.tag.show', compact('tag','prev_tag_id','next_tag_id'));
    }

    /**
     * 新增标签视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.tag.create');
    }


    /**
     * 新增标签
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
            'name.required' => '标签名称为必填项',
            'name.alpha_dash' => '标签名称仅允许字母、数字、破折号（-）以及下划线（_）',
            'name.max' => '标签名称不得超过36个字符'
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
        if (Tag::create($data)) {
            // 新增标签成功
            return response()->json([
                'status' => 200,
                'message' => '新增成功'
            ]);
        } else {
            // 新增标签失败
            return response()->json([
                'status' => 400,
                'message' => '新增失败'
            ]);
        }
    }


    /**
     * 编辑标签视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        if (empty($tag)) {
            die('标签不存在');
        }

        return view('backend.tag.edit', compact('tag'));
    }


    /**
     * 更新标签
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
            'name.required' => '标签名称为必填项',
            'name.alpha_dash' => '标签名称仅允许字母、数字、破折号（-）以及下划线（_）',
            'name.max' => '标签名称不得超过36个字符'
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
        $tag = Tag::find($id);
        $tag->name = $data['name'];

        if ($tag->save()) {
            // 更新标签成功
            return response()->json([
                'status' => 200,
                'message' => '修改成功'
            ]);
        } else {
            // 更新标签失败
            return response()->json([
                'status' => 400,
                'message' => '修改失败'
            ]);
        }
    }


    /**
     * 删除标签
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        if (count($tag->posts)) {
            return response()->json([
                'status' => 400,
                'message' => '存在文章，不能删除'
            ]);
        }

        if ($tag->delete()) {
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
