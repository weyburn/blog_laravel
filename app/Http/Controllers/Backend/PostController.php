<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\BackendController;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Validator;

/**
 * 文章控制器
 * Class PostController
 * @package App\Http\Controllers\Backend
 */
class PostController extends BackendController
{
    /**
     * 文章列表视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::all();

        return view('backend.post.index', compact('posts'));
    }


    /**
     * 文章详情视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            die('文章不存在');
        }

        $prev_post_id = Post::where('id', '<', $id)->max('id');
        $next_post_id = Post::where('id', '>', $id)->min('id');

        return view('backend.post.show', compact('post', 'prev_post_id', 'next_post_id'));
    }


    /**
     * 新增文章视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        return view('backend.post.create', compact('categories', 'tags'));
    }


    /**
     * 新增文章
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // 获取请求数据
        $data = $request->only([
            'title',
            'status',
            'category_id',
            'content',
            'tag_id',
        ]);

        // 校验规则
        $rule = [
            'title' => 'bail|required|max:255',
            'status' => 'bail|required|integer|in:0,1',
            'content' => 'required',
            'category_id' => 'bail|required|integer',
            'tag_id' => 'array'
        ];

        // 错误消息
        $messages = [
            'required' => ':attribute为必填项',
            'max' => ':attribute不得超过255个字符',
            'integer' => ':attribute必须为整数',
            'in:0,1' => ':attribute必须为0或1',
            'array' => ':attribute必须为数组'
        ];

        // 自定义属性
        $customAttributes = [
            'title' => '文章标题',
            'status' => '状态',
            'content' => '文章内容',
            'category_id' => '分类id',
            'tag_id' => '标签id'
        ];

        // 校验数据
        $validator = Validator::make($data, $rule, $messages, $customAttributes);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        // 校验成功
        // 当状态为发布（即status = 1）时，获取发布时间
        if ($data['status'] == 1) {
            $data['published_at'] = Carbon::now();
        }

        // 启动事务
        DB::beginTransaction();
        try {
            $post = Post::create($data);
            if (isset($data['tag_id'])) {
                $post->tags()->attach($data['tag_id']);
            }
            // 提交事务
            DB::commit();
            // 新增文章成功
            return response()->json([
                'status' => 200,
                'message' => '新增成功'
            ]);
        } catch (\Exception $exception) {
            // 回滚事务
            DB::rollBack();
            // 新增文章失败
            return response()->json([
                'status' => 400,
                'message' => '新增失败'
            ]);
        }
    }


    /**
     * 编辑文章视图
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            die('文章不存在');
        }

        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();

        $tagArr = [];
        if (count($post->tags)) {
            foreach ($post->tags as $tag) {
                $tagArr[$tag->id] = $tag->name;
            }
        }

        return view('backend.post.edit', compact('post', 'categories', 'tags', 'tagArr'));
    }


    /**
     * 更新文章
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        // 获取请求数据
        $data = $request->only([
            'title',
            'status',
            'category_id',
            'content',
            'tag_id',
        ]);

        // 校验规则
        $rule = [
            'title' => 'bail|required|max:255',
            'status' => 'bail|required|integer|in:0,1',
            'content' => 'required',
            'category_id' => 'bail|required|integer',
            'tag_id' => 'array'
        ];

        // 错误消息
        $messages = [
            'required' => ':attribute为必填项',
            'max' => ':attribute不得超过255个字符',
            'integer' => ':attribute必须为整数',
            'in:0,1' => ':attribute必须为0或1',
            'array' => ':attribute必须为数组'
        ];

        // 自定义属性
        $customAttributes = [
            'title' => '文章标题',
            'status' => '状态',
            'content' => '文章内容',
            'category_id' => '分类id',
            'tag_id' => '标签id'
        ];

        // 校验数据
        $validator = Validator::make($data, $rule, $messages, $customAttributes);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        // 校验成功
        $post = Post::find($id);
        $post->title = $data['title'];
        $post->status = $data['status'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];
        // 当修改前发布时间不存在、修改后状态为发布（即status = 1）时，获取发布时间
        if (empty($post->published_at) && $data['status'] == 1) {
            $post->published_at = Carbon::now();
        }

        // 启动事务
        DB::beginTransaction();
        try {
            $post->save();
            $updatePostTag = isset($data['tag_id']) ? $data['tag_id'] : null;
            $post->tags()->sync($updatePostTag);
            // 提交事务
            DB::commit();
            // 更新文章成功
            return response()->json([
                'status' => 200,
                'message' => '修改成功'
            ]);
        } catch (\Exception $exception) {
            // 回滚事务
            DB::rollBack();
            // 更新文章失败
            return response()->json([
                'status' => 400,
                'message' => '修改失败'
            ]);
        }
    }


    /**
     * 删除文章
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // 启动事务
        DB::beginTransaction();
        try {
            $post->tags()->detach();
            $post->comments()->delete();
            $post->delete();
            // 提交事务
            DB::commit();
            // 删除成功
            return response()->json([
                'status' => 200,
                'message' => '删除成功'
            ]);
        } catch (\Exception $exception) {
            // 回滚事务
            DB::rollBack();
            // 删除失败
            return response()->json([
                'status' => 400,
                'message' => '删除失败'
            ]);
        }
    }
}
