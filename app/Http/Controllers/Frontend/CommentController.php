<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Validator;

/**
 * 评论控制器
 * Class CommentController
 * @package App\Http\Controllers\Frontend
 */
class CommentController extends FrontendController
{
    /**
     * 新增评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        // 获取请求数据
        $data = $request->only([
            'name',
            'email',
            'website',
            'content',
            'post_id',
            'reply_id',
            'reply_name'
        ]);

        // 校验规则
        $rule = [
            'name' => 'bail|required|max:40',
            'email' => 'bail|required|email|max:64',
            'website' => 'nullable|max:120',
            'content' => 'bail|required|max:300',
            'post_id' => 'bail|required|integer',
            'reply_id' => 'nullable|integer',
            'reply_name' => 'nullable|max:40'
        ];

        // 错误消息
        $messages = [
            'required' => ':attribute为必填项',
            'max' => ':attribute不得超过:max个字符',
            'email' => ':attribute格式不正确',
            'integer' => ':attribute必须为整数'
        ];

        // 自定义属性
        $customAttributes = [
            'name' => '称呼',
            'email' => '邮箱',
            'website' => '网址',
            'content' => '评论内容',
            'post_id' => '所评文章id',
            'reply_id' => '回复id',
            'reply_name' => '回复昵称'
        ];

        // 基础校验数据
        $validator = Validator::make($data, $rule, $messages, $customAttributes);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first(),
            ]);
        }

        // 校验成功
        // 获取访问ip
        $data['ip'] = $request->getClientIp();

        if (Comment::create($data)) {
            // 添加评论成功
            return response()->json([
                'status' => 200,
                'message' => '评论成功'
            ]);
        } else {
            //  添加评论失败
            return response()->json([
                'status' => 400,
                'message' => '评论失败'
            ]);
        }
    }
}
