<?php

namespace App\Http\Controllers\Backend;

use App\Comment;
use App\Http\Controllers\BackendController;

/**
 * 评论控制器
 * Class CommentController
 * @package App\Http\Controllers\Backend
 */
class CommentController extends BackendController
{
    /**
     * 评论列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comments = Comment::all();

        return view('backend.comment.index', compact('comments'));
    }


    /**
     * 评论详情视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (empty($comment)) {
            die('评论不存在');
        }

        $prev_comment_id = Comment::where('id', '<', $id)->max('id');
        $next_comment_id = Comment::where('id', '>', $id)->min('id');

        return view('backend.comment.show',compact('comment','prev_comment_id','next_comment_id'));
    }


    /**
     * 修改评论状态
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $comment = Comment::find($id);
        $comment->status = 1;

        if ($comment->save()) {
            // 更新评论状态成功
            return response()->json([
                'status' => 200,
                'message' => '修改成功'
            ]);
        } else {
            // 更新评论状态失败
            return response()->json([
                'status' => 400,
                'message' => '修改失败'
            ]);
        }
    }


    /**
     * 删除评论
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment->delete()) {
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
